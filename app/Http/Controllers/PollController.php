<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;
use App\User;
use Auth;
use App\Traits\SpecificPoll;


class PollController extends Controller
{
    use SpecificPoll;

    public function showAllPolls() 
    {
        $polls = Poll::all();
        return view('polls')->with('polls', $polls);
    }

    public function getPollsFromUser()
    {
        $polls = $this->getPollFromUser(Auth::user()->id);
        return response()->json($polls);
    }

    public function deletePoll($id){
        $poll = Poll::findOrFail($id);
        $poll->delete();
        return 200;
    }
    
    public function showOnePoll($url)
    {
        $poll = Poll::where('url', '=', $url)->first();
        return view('poll')->with('pollId', $poll['id']);
    }

    public function getOnePoll($id)
    {
        $poll = Poll::findOrFail($id);
        return response()->json($poll);
    }

    public function createNewPoll(Request $request)
    {
        $poll = new Poll;
        $user = Auth::user();
        
        $poll->title = $request->name;
        $poll->choices = $request->options;
        $slug = str_slug($request->name, "-");
        $poll->url = $slug;

        $clone = Poll::where('url', '=', $slug)->first();
        if($clone !== null){
            return response(400);
        }
         
        $user->polls()->save($poll);
        return response()->json($poll->url);
    }

    public function vote(Request $request)
    {
        $id = $request->poll["id"];
        $index = $request->index;

        $poll = Poll::findOrFail($id);

        $count = $poll->choices[$index]['votes'];
        $array = $poll->choices;
        
        foreach ($array as $key => $oo){
            if($key !== $index){
                $restArray[] = array('votes' => $oo['votes'], 'name' => $oo['name']);      
            }
        }

        $firstItem = array('votes' => ++$count, 'name' => $poll->choices[$index]['name']);

        array_unshift($restArray, $firstItem);

        $poll->choices = $restArray;
        $poll->save();
        return response()->json($poll);
    }
}
