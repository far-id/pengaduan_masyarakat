<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Masyarakat;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ( $validator->fails() ) {
            return response()->json($validator->errors(), 
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    
        $user = User::where('username', $request->username)->first();
    
        if (! $user || !Hash::check($request->password, $user->password)) {
            return response([
                'username' => ['The provided credentials are incorrect.'],
            ], 404);
        }
    
        return $user->createToken('my-token')->plainTextToken;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'min:3', 'max:25', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
        ]);

        if ( $validator->fails() ) {
            return response()->json($validator->errors(), 
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }

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
                $user->level = 'masyarakat';
                $user->save();
                
                Masyarakat::where('nik',$request->nik)->update([
                    'user_id' => $user->id
                ]);
                
                $response = [
                    'message' => 'User registered',
                    'data' => $user
                ];
            } else {
                $response = [
                    'message' => 'Nik not found'
                ];
            }
        } else {
            $response = [
                'message' => 'kk not found'
            ];
        }
        
        return response()->json($response, Response::HTTP_CREATED);
    }
}
