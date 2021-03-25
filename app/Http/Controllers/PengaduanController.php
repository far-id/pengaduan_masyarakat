<?php

namespace App\Http\Controllers;

use App\Pengaduan;
use App\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::where('pengadu_id',Auth()->id())
                                ->get()
                                ->SortByDesc('created_at')
                                ->where('jenis', 'pengaduan');
        return view('pengaduan.index', compact('pengaduan'));
    }

    public function create()
    {
        return view('pengaduan.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'image' => 'File yang diupload harus berupa gambar',
            'mimes' => 'Gambar yang diupload berupa jpeg,png,jpg',
            'max' => 'Gambar yang diupload tidak boleh lebih dari 2 MB',
            'min' => 'Pengaduan berisi sedikitnya 30 karakter'
        ];

        $this->validate($request,[
            'aduan' => 'required|string|min:30',
            'img.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ],$messages);
        $gambar = "";
        // dd($request->pengaduan);
        if($request->hasfile('img')){
            foreach($request->file('img') as $image){
                $extension = $image->getClientOriginalName();
                $filename = time() . "_" . $extension;
                $image->move('img/pengaduan', $filename);
                $data[] = $filename;
                $gambar = json_encode($data);
            }
        }
        if ( $request->radio == 'pengaduan' ){
            $jenis = 'pengaduan';
        }
        else{
            $jenis = 'aspirasi';
        }

        $pengaduan = new Pengaduan();
        $pengaduan->aduan = $request->aduan;
        $pengaduan->gambar = $gambar;
        $pengaduan->pengadu_id = Auth::user()->id;
        $pengaduan->tanggapan = '';
        $pengaduan->penanggap_id = null;
        $pengaduan->status = 'terkirim';
        $pengaduan->jenis = $jenis;
        $pengaduan->created_at = now();
        $pengaduan->updated_at = null;


        $pengaduan->save();
        if ( $jenis == 'pengaduan'){
            return redirect('/pengaduan')->with(['success'=>'Pengaduan anda telah terkirim']);
        }else{
            return redirect('/aspirasi')->with(['success'=>'Aspirasi anda telah terkirim']);
        }
    }

    public function showPengaduan($id)
    {
        $pengaduan = Pengaduan::where('pengaduans.id', $id)
                                ->get();
        $penanggap = Petugas::where('user_id', $pengaduan[0]['penanggap_id'])->get();
        return view('pengaduan.showPengaduan', compact('pengaduan', 'penanggap'));
    }

    public function aspirasi()
    {
        $aspirasi = Pengaduan::where('pengadu_id', auth()->id())->get()->SortByDesc('created_at')
                                ->where('jenis', 'aspirasi');
        return view('pengaduan.aspirasi', compact('aspirasi'));
    }

    public function showAspirasi($id)
    {
        $aspirasi = Pengaduan::where('pengaduans.id', $id)
                                ->get();
        $penanggap = Petugas::where('user_id', $aspirasi[0]['penanggap_id'])->get();
        return view('pengaduan.showAspirasi', compact('aspirasi', 'penanggap'));
    }
}
