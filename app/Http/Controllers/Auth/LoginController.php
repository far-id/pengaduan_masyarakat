<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    

    /**
     * Get the login username to be used by the controller.
     *  
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    public function login()
    {
        // return 'nip';
        $username = request()->input('username');
        $password = request()->input('password');
        if(Auth::attempt(['username' => $username, 'password' => $password], true)){
            if(Auth::user()->level == "admin"){
                return redirect()->route('home');
            }
            elseif(Auth::user()->level == "petugas"){
                return redirect()->route('home');
            }
            elseif(Auth::user()->level == "masyarakat"){
                return redirect()->route('home');
            }
            else{
                abort(404);
            }
            
            // Auth::logout();
            // return redirect()->route('login');
        } elseif(!Auth::attempt(['username'=> $username, 'password'=>$password], false)){
            return redirect()->back()->with('error', 'Username/password salah');
        }
        
        
    }
}
