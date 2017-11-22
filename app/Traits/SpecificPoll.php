<?php

namespace App\Traits;

use App\Poll;
use App\User;

trait SpecificPoll
{

private function getPollFromUser($id)
    {
        $user = User::where('id', $id)->with('polls')->first();
        $polls = $user->polls;
        
        if(!$polls->isEmpty()){
            return $polls;
        } else {
            return 0;
        }
        
    }


}   