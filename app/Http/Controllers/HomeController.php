<?php

namespace App\Http\Controllers;

use App\Kegiatan;
use App\Pengaduan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $bulan = Pengaduan::all();
        // $be = [];
        $tahun = now()->format('Y');

        $jan = Pengaduan::whereMonth('created_at', '01')->whereYear('created_at', $tahun)->where('jenis', 'pengaduan')->get();
        $feb = Pengaduan::whereMonth('created_at', '02')->whereYear('created_at', $tahun)->where('jenis', 'pengaduan')->get();
        $mar = Pengaduan::whereMonth('created_at', '03')->whereYear('created_at', $tahun)->where('jenis', 'pengaduan')->get();
        $apr = Pengaduan::whereMonth('created_at', '04')->whereYear('created_at', $tahun)->where('jenis', 'pengaduan')->get();
        $mei = Pengaduan::whereMonth('created_at', '05')->whereYear('created_at', $tahun)->where('jenis', 'pengaduan')->get();
        $jun = Pengaduan::whereMonth('created_at', '06')->whereYear('created_at', $tahun)->where('jenis', 'pengaduan')->get();
        $jul = Pengaduan::whereMonth('created_at', '07')->whereYear('created_at', $tahun)->where('jenis', 'pengaduan')->get();
        $agu = Pengaduan::whereMonth('created_at', '08')->whereYear('created_at', $tahun)->where('jenis', 'pengaduan')->get();
        $sep = Pengaduan::whereMonth('created_at', '09')->whereYear('created_at', $tahun)->where('jenis', 'pengaduan')->get();
        $okt = Pengaduan::whereMonth('created_at', '10')->whereYear('created_at', $tahun)->where('jenis', 'pengaduan')->get();
        $nov = Pengaduan::whereMonth('created_at', '11')->whereYear('created_at', $tahun)->where('jenis', 'pengaduan')->get();
        $des = Pengaduan::whereMonth('created_at', '12')->whereYear('created_at', $tahun)->where('jenis', 'pengaduan')->get();
        
        $pengaduan = [
            $jan = count($jan),
            $feb = count($feb),
            $mar = count($mar),
            $apr = count($apr),
            $mei = count($mei),
            $jun = count($jun),
            $jul = count($jul),
            $agu = count($agu),
            $sep = count($sep),
            $okt = count($okt),
            $nov = count($nov),
            $des = count($des),
        ];
        $jan = Pengaduan::whereMonth('created_at', '01')->whereYear('created_at', $tahun)->where('jenis', 'aspirasi')->get();
        $feb = Pengaduan::whereMonth('created_at', '02')->whereYear('created_at', $tahun)->where('jenis', 'aspirasi')->get();
        $mar = Pengaduan::whereMonth('created_at', '03')->whereYear('created_at', $tahun)->where('jenis', 'aspirasi')->get();
        $apr = Pengaduan::whereMonth('created_at', '04')->whereYear('created_at', $tahun)->where('jenis', 'aspirasi')->get();
        $mei = Pengaduan::whereMonth('created_at', '05')->whereYear('created_at', $tahun)->where('jenis', 'aspirasi')->get();
        $jun = Pengaduan::whereMonth('created_at', '06')->whereYear('created_at', $tahun)->where('jenis', 'aspirasi')->get();
        $jul = Pengaduan::whereMonth('created_at', '07')->whereYear('created_at', $tahun)->where('jenis', 'aspirasi')->get();
        $agu = Pengaduan::whereMonth('created_at', '08')->whereYear('created_at', $tahun)->where('jenis', 'aspirasi')->get();
        $sep = Pengaduan::whereMonth('created_at', '09')->whereYear('created_at', $tahun)->where('jenis', 'aspirasi')->get();
        $okt = Pengaduan::whereMonth('created_at', '10')->whereYear('created_at', $tahun)->where('jenis', 'aspirasi')->get();
        $nov = Pengaduan::whereMonth('created_at', '11')->whereYear('created_at', $tahun)->where('jenis', 'aspirasi')->get();
        $des = Pengaduan::whereMonth('created_at', '12')->whereYear('created_at', $tahun)->where('jenis', 'aspirasi')->get();
        $aspirasi = [
            $jan = count($jan),
            $feb = count($feb),
            $mar = count($mar),
            $apr = count($apr),
            $mei = count($mei),
            $jun = count($jun),
            $jul = count($jul),
            $agu = count($agu),
            $sep = count($sep),
            $okt = count($okt),
            $nov = count($nov),
            $des = count($des),
        ];

        $kegiatan = Kegiatan::join('petugas', 'kegiatans.user_id', '=', 'petugas.user_id')
                            ->select('kegiatans.*', 'petugas.nama')
                            ->get()
                            ->sortByDesc('created_at');
        return view('dashboard', ['pengaduan' => $pengaduan, 'aspirasi' => $aspirasi], compact('kegiatan'));
    }
}
