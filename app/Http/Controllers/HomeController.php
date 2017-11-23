<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Traits\SpecificPoll;

class HomeController extends Controller
{
    use SpecificPoll;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'showProfile']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function showProfile()
    {
        return view('profile');
    }

    public function loggingOut()
    {
        if(Auth::check()) {
            Auth::logout();
        }

        return view('home');
    }
}
