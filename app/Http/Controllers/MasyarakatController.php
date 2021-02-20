<?php

namespace App\Http\Controllers;

use App\Masyarakat;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class MasyarakatController extends Controller
{
    public function index()
    {
        $mas = Masyarakat::all()
                            ->sortBy('kk')
                            ->sortBy('nik');
        return vieW('masyarakat.index', compact('mas'));
    }

    public function create()
    {
        return view('masyarakat.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'unique' => 'NIK sudah terdaftar',
            // 'max' => 'NIK/KK terlalu panjang',
            // 'min' => 'NIK/KK terlalu pendek',
        ];
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'kk' => 'required|numeric|digits_between:15,17',
            'nik' => 'required|numeric|digits_between:15,17|unique:App\Masyarakat,nik',
        ], $messages);

        $masyarakat = new Masyarakat();
        $masyarakat->user_id = null;
        $masyarakat->nama = Str::of($request->name)->upper();
        $masyarakat->kk = $request->kk;
        $masyarakat->nik = $request->nik;
        $masyarakat->telpon = $request->telpon;
        $masyarakat->lahir = $request->lahir;
        $masyarakat->created_at = now();
        $masyarakat->updated_at = null;

        $masyarakat->save();
        return redirect('/masyarakat');
    }

    public function pdf()
    {
        $masyarakat = Masyarakat::get()
                                ->sortBy('kk')
                                ->sortBy('nik');
        $mas = Masyarakat::join('users', 'masyarakats.user_id', 'users.id')
                                ->select('masyarakats.*', 'users.username as username', 'users.id AS userid')
                                ->get()
                                ->sortBy('kk')
                                ->sortBy('nik');
        // dd($masyarakat->username);
        $pdf = PDF::loadView('masyarakat.pdf', compact('masyarakat', 'mas'))
                    ->setPaper('a4', 'potrait');
        return $pdf->stream('masyarakat.pdf');
    }
}
