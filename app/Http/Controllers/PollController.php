<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;

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
}
