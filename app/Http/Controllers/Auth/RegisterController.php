<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
use App\Masyarakat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    // use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, []);
    }

    protected function regist(Request $request)
    {
        $messages = [
            'unique' => 'Username sudah ada',
            'max' => 'Username terlalu panjang',
            'min' => 'Username/password anda terlalu pendek',
            'confirmed' => 'Konfirmasi password tidak sesuai',
            'kk' => 'kk tidak ada',
        ];
        $validated = $request->validate([
            'username' => ['required', 'string', 'min:3', 'max:25', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
        ], $messages);

        $kk = Masyarakat::where([
            ['kk', $request->kk]
        ])->first();
        $nik = Masyarakat::where([
            ['nik', $request->nik]
        ])->first();
        if ( $kk == true ) {
            if ( $nik == true ) {
                $user = new User;
                $user->username = $request->username;
                $user->password = bcrypt($request->password);
                $user->level = $request->level;
                $user->save();
                
                Masyarakat::where('nik',$request->nik)->update([
                    'user_id' => $user->id
                ]);
                
                return redirect('login');
            } else {
                return Redirect::back()->withErrors(['nik tidak ada']);
            }
        } else {
            return Redirect::back()->withErrors(['kk tidak ada']);
        }
        
        
        
    }
}
