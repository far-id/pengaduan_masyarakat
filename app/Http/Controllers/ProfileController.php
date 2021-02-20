<?php

namespace App\Http\Controllers;

use App\Masyarakat;
use App\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        if ( auth()->user()->level == 'masyarakat' )
        {
            $profil = Masyarakat::join('users', 'masyarakats.user_id', '=', 'users.id')
                                ->where('user_id', Auth::user()->id)
                                ->select('masyarakats.*', 'users.username')
                                ->get();
            return view('profile.masyarakat', compact('profil'));
        }
        $profil = Petugas::join('users', 'Petugas.user_id', '=', 'users.id')
                                ->where('user_id', Auth::user()->id)
                                ->select('Petugas.*', 'users.username')
                                ->get();
        return view('profile.Petugas', compact('profil'));
    }

    public function updateM($id, Request $request)
    {
        $profil = Masyarakat::find($id);
        $profil->telpon = $request->telpon;
        $profil->alamat = $request->alamat;
        $profil->save();
        return redirect('/profile');
    }

    public function updateP($id, Request $request)
    {
        $profil = Petugas::find($id);
        $profil->telpon = $request->telpon;
        $profil->save();
        return redirect('/profile');
    }
}
