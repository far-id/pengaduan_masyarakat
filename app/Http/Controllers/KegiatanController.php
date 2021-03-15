<?php

namespace App\Http\Controllers;

use App\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        if (auth()->user()->level == 'admin')
        {
            $kegiatan = Kegiatan::all()
                                ->SortByDesc('created_at');
            return view('kegiatan.index', compact('kegiatan'));
        }
        $kegiatan = Kegiatan::where('user_id',Auth()->id())
                            ->get()
                            ->SortByDesc('created_at');
        return view('kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        return view('kegiatan.create');
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
            'judul' => 'required|string',
            'kegiatan' => 'required|string',
            'img.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ],$messages);
        $gambar = "";
        
        if($request->hasfile('img')){
            foreach($request->file('img') as $image){
                $extension = $image->getClientOriginalName();
                $filename = time() . "_" . $extension;
                $image->move('img/kegiatan', $filename);
                $data[] = $filename;
                $gambar = json_encode($data);
            }
        }

        $kegiatan = new Kegiatan();
        $kegiatan->user_id = auth()->user()->id;
        $kegiatan->judul = $request->judul;
        $kegiatan->kegiatan = $request->kegiatan;
        $kegiatan->gambar = $gambar;
        $kegiatan->created_at = now();
        $kegiatan->updated_at = null;

        $kegiatan->save();
        return redirect('/kegiatan')->with(['success' => 'Kegiatan telah dibuat']);
    }

    public function destroy($id)
    {
        Kegiatan::destroy($id);
        return redirect('/kegiatan')->with(['success' => 'Kegiatan dihapus']);
    }
}
