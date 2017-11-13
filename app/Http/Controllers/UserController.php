<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\User;
use Auth;


class UserController extends BaseController
{
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

        $user = new User;
        $user->name = $request->name;
        $user->password = $request->password;
        $user->email = $request->email;
        $user->save();
        Auth::login($user);
        return redirect()->route('profile');
    }

    public function editUser()
    {

    }


    public function deleteUser()
    {
        
    }
}
