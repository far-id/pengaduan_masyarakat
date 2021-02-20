<?php

namespace App\Http\Controllers;

use App\User;
use App\Petugas;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

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
        return view('petugas.index', compact('petugas'));
    }


    public function create()
    {
        return view('petugas.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'unique' => 'Username sudah ada',
            'max' => 'Username terlalu panjang',
            'min' => 'Username/password anda terlalu pendek',
            'confirmed' => 'Konfirmasi password tidak sesuai',
        ];
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'min:3', 'max:25', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
            'radio' => ['required', 'string', 'max:10'],
        ], $messages);

        if ( $request->radio == 'admin' ){
            $level = 'admin';
        }
        else{
            $level = 'petugas';
        }

        $user = new User();
        $user->username = $request->username;
        $user->password =  bcrypt($request->password);
        $user->level = $level;
        $user->created_at = now();
        $user->updated_at = null;
        $user->save();
        
        $petugas = new Petugas();
        $petugas->user_id = $user->id;
        $petugas->nama = $request->name;
        $petugas->level = $level;
        $petugas->telpon = $request->telpon;
        $petugas->created_at = now();
        $petugas->updated_at = null;
        $petugas->save();

        return redirect('/petugas');
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
