<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use App\Petugas;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = User::join('petugas', 'users.id', 'petugas.user_id')
                        ->select('users.*', 'petugas.nama as nama', 'petugas.telpon as telpon')
                        ->where('petugas.level', 'admin')
                        ->orWhere('petugas.level', 'petugas')
                        ->get()
                        ->sortBy('users.created_at');
        $response = [
            'message' =>  'List petugas',
            'pengaduan' => $petugas
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'min:3', 'max:25', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
            'radio' => ['required', 'string', 'max:10'],
        ]);

        if ( $validator->fails() ) {
            return response()->json($validator->errors(), 
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $user = new User();
            $user->username = $request->username;
            $user->password =  bcrypt($request->password);
            $user->level = $request->level;
            $user->created_at = now();
            $user->updated_at = null;
            $user->save();
            
            $petugas = new Petugas();
            $petugas->user_id = $user->id;
            $petugas->nama = $request->name;
            $petugas->level = $request->level;
            $petugas->telpon = $request->telpon;
            $petugas->created_at = now();
            $petugas->updated_at = null;
            $petugas->save();
            $response = [
                'message' => 'transaction created',
                'user' => $user,
                'petugas' => $petugas
            ];
            return response()->json($response, Response::HTTP_CREATED);
        
        } catch (QueryException $e) {
            return response()->json([
                "message" => "Failed" . $e
            ]);
        }
    }

    public function pdf()
    {
        $petugas = User::join('petugas', 'users.id', 'petugas.user_id')
                        ->select('users.*', 'petugas.nama as nama', 'petugas.telpon as telpon')
                        ->where('petugas.level', 'admin')
                        ->orWhere('petugas.level', 'petugas')
                        ->get()
                        ->sortBy('users.created_at');
        $pdf = PDF::loadView('petugas.pdf', compact('petugas'))
                    ->setPaper('a4', 'potrait');;
        return $pdf->stream('petugas.pdf');
    }
}
