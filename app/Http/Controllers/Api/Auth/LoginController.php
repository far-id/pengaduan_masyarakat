<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'username'	=> 'required',
            'password' => 'required'
        ]);
    
        $user = User::where('username', $request->username)->first();
    
        if (! $user || !Hash::check($request->password, $user->password)) {
            return response([
                'username' => ['The provided credentials are incorrect.'],
            ], 404);
        }
    
        return $user->createToken('my-token')->plainTextToken;
    }
}
