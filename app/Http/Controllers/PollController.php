<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;
use App\User;
use Auth;


class PollController extends Controller
{
    public function showAllPolls() 
    {
        $polls = Poll::all();
        return view('polls')->with('polls', $polls);
    }

    public function editPoll($id)
    {

    }
    
    public function showOnePoll($id)
    {

    }

    public function deletePoll($id)
    {

    }

    public function createNewPoll(Request $request)
    {
        $poll = new Poll;
        $user = Auth::user();
        
        $poll->title = $request->name;
        $poll->choices = $request->options;
        $poll->url = str_slug($request->name, "-");
        $user->polls()->save($poll);
        return 200;
    }
}
