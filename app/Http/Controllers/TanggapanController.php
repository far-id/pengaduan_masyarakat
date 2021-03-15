<?php

namespace App\Http\Controllers;

use App\Pengaduan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;

class TanggapanController extends Controller
{
    //pengaduan
    public function index(){
        $pengaduan = Pengaduan::join('masyarakats', 'pengaduans.pengadu_id', '=', 'masyarakats.user_id')
                                ->select('pengaduans.*', 'masyarakats.nama AS namaPengadu', 'masyarakats.nik')
                                ->where('pengaduans.jenis', 'pengaduan')
                                ->where('pengaduans.status', 'terkirim')
                                ->get()
                                ->SortByDesc('pengaduans.created_at');
        return view('tanggapan.pengaduan.index', compact('pengaduan'));
    }

    public function show($id){
        $pengaduan = Pengaduan::join('masyarakats', 'pengaduans.pengadu_id', '=', 'masyarakats.user_id')
                                ->select('pengaduans.*', 'masyarakats.nama AS namaPengadu', 'masyarakats.nik')
                                ->where('pengaduans.id', $id)
                                ->get();
        return view('tanggapan.pengaduan.show', compact('pengaduan'));
    }

    public function tanggapan(Request $request, $id)
    {
        $messages = [
            'required' => 'kolom ini harus diisi',
            'min' => 'Pengaduan berisi sedikitnya 10 karakter'
        ];

        $this->validate($request,[
            'tanggapan' => 'required|string|min:10',
        ],$messages);

        if ( $request->radio == 'proses' ){
            $status = 'proses';
        }
        else{
            $status = 'selesai';
        }

        $tanggapan = Pengaduan::find($id);
        $tanggapan->tanggapan = $request->tanggapan;
        $tanggapan->penanggap_id = Auth::user()->id;
        $tanggapan->status = $status;
        $tanggapan->updated_at = now();

        $tanggapan->save();
        return redirect('masyarakat/pengaduan');
    }
    
    public function pengaduanPdf(){
        $pengaduan = Pengaduan::join('masyarakats', 'pengaduans.pengadu_id', '=', 'masyarakats.user_id')
                                ->join('petugas', 'pengaduans.penanggap_id', '=', 'petugas.user_id')
                                ->select('pengaduans.*', 'masyarakats.nama AS namaPengadu', 'masyarakats.nik', 'petugas.nama AS namaPenanggap')
                                ->where('pengaduans.jenis', 'pengaduan')
                                ->get()
                                ->SortByDesc('pengaduans.created_at');
        $pdf = PDF::loadView('tanggapan.pengaduan.pdf', compact('pengaduan'))
                    ->setPaper('a4', 'landscape');;
        return $pdf->stream('pengaduan.pdf');
    }

    //aspirasi
    public function aspirasi(){
        $pengaduan = Pengaduan::join('masyarakats', 'pengaduans.pengadu_id', '=', 'masyarakats.user_id')
                                ->select('pengaduans.*', 'masyarakats.nama AS namaPengadu', 'masyarakats.nik')
                                ->where('pengaduans.jenis', 'aspirasi')
                                ->where('pengaduans.status', 'terkirim')
                                ->get()
                                ->SortByDesc('pengaduans.created_at');
        return view('tanggapan.aspirasi.index', compact('pengaduan'));
    }

    public function detailAspirasi($id){
        $pengaduan = Pengaduan::join('masyarakats', 'pengaduans.pengadu_id', '=', 'masyarakats.user_id')
                                ->select('pengaduans.*', 'masyarakats.nama AS namaPengadu', 'masyarakats.nik')
                                ->where('pengaduans.id', $id)
                                ->get();
        return view('tanggapan.aspirasi.show', compact('pengaduan'));
    }

    public function tanggapanAspirasi(Request $request, $id)
    {
        $messages = [
            'required' => 'kolom ini harus diisi',
            'min' => 'Pengaduan berisi sedikitnya 10 karakter'
        ];

        $this->validate($request,[
            'tanggapan' => 'required|string|min:10',
        ],$messages);

        if ( $request->radio == 'Terima' ){
            $status = 'diterima';
        }
        else{
            $status = 'Ditolak';
        }

        $tanggapan = Pengaduan::find($id);
        $tanggapan->tanggapan = $request->tanggapan;
        $tanggapan->penanggap_id = Auth::user()->id;
        $tanggapan->status = $status;
        $tanggapan->updated_at = now();

        $tanggapan->save();
        return redirect('masyarakat/aspirasi');
    }

    public function aspirasiPdf(){
        $aspirasi = Pengaduan::join('masyarakats', 'pengaduans.pengadu_id', '=', 'masyarakats.user_id')
                            ->join('petugas', 'pengaduans.penanggap_id', '=', 'petugas.user_id')
                            ->select('pengaduans.*', 'masyarakats.nama AS namaPengaspi', 'masyarakats.nik', 'petugas.nama AS namaPenanggap')
                            ->where('pengaduans.jenis', 'aspirasi')
                            ->get()
                            ->SortBy('pengaduans.created_at');
        $pdf = PDF::loadView('tanggapan.aspirasi.pdf', compact('aspirasi'))
                    ->setPaper('a4', 'landscape');;
        return $pdf->stream('aspirasi.pdf');
    }

}
