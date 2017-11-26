<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
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
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->save();
        Auth::login($user);
        return redirect()->route('profile');
    }

    public function getCurrentUser()
    {
        $user = Auth::user();
        return response()->json($user);
    }

    public function saveChanges(Request $request)
    {
        $user = Auth::user();
        if($user){
            if(isset($request->user['email']) && $request->user['email'] !== null){
                $user->email = $request->user['email'];
            }
            
            if(isset($request->user['name']) && $request->user['name'] !== null){
                $user->name = $request->user['name'];
            }

            if(isset($request->user['password']) && $request->user['password'] !== null){
                $user->password = Hash::make($request->user['password']);
            }
            
            $user->save();
            return response(200);
        }
    }

    public function isLoggedIn()
    {
        if(Auth::user()){
            return response()->json(Auth::user());
        } else {
            return response()->json(false);
        }
    }

}
