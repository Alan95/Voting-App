<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Poll;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    private function getPollFromUser($id)
    {
        $polls = Poll::where('id', '=', $id)->get();
        if(!$polls->isEmpty()){
            return $polls;
        } else {
            return 0;
        }
        
    }

    public function authenticate(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $polls = $this->getPollFromUser(Auth::user()->id);
            return redirect()->route('profile')->with('polls', $polls);
        } else {
            return back()->withInput()->with('message', 'Wrong email/password combination.');
        }
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }

}