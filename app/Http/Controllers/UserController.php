<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function showHome()
    {
        return view('home');
    }
    public function showRegisterForm()
    {
        return view('register');
    }

    public function addNewUser(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'password' => 'required|max:255',
            'email' => ''
        ]);

        return 200;
    }
}
