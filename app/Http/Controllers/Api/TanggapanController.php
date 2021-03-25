<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pengaduan;
use Barryvdh\DomPDF\PDF;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class TanggapanController extends Controller
{
    //pengaduan
    public function index()
    {
        $pengaduan = Pengaduan::join('masyarakats', 'pengaduans.pengadu_id', '=', 'masyarakats.user_id')
                                ->select('pengaduans.*', 'masyarakats.nama AS namaPengadu', 'masyarakats.nik')
                                ->where('pengaduans.jenis', 'pengaduan')
                                ->where('pengaduans.status', 'terkirim')
                                ->get()
                                ->SortByDesc('pengaduans.created_at');
        $response = [
            'message' =>  'List pengaduan belum ditanggapi',
            'pengaduan' => $pengaduan
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::join('masyarakats', 'pengaduans.pengadu_id', '=', 'masyarakats.user_id')
                                ->select('pengaduans.*', 'masyarakats.nama AS namaPengadu', 'masyarakats.nik')
                                ->where('pengaduans.id', $id)
                                ->get();
        $response = [
            'message' => 'Detail pengaduan',
            'pengaduan' => $pengaduan
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function tanggapan(Request $request, $id)
    {
        $tanggapan = Pengaduan::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'tanggapan' => ['required', 'string', 'min:10']
        ]);
        if ( $validator->fails() ) {
            return response()->json($validator->errors(), 
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $tanggapan->tanggapan = $request->tanggapan;
            $tanggapan->penanggap_id = $request->user()->id;
            $tanggapan->status = $request->status;// proses | selesai
            $tanggapan->updated_at = now();

            $tanggapan->save();
            $response = [
                'message' => 'Pengaduan ditanggapi',
                'pengaduan' => $tanggapan
            ];
            return response()->json($response, Response::HTTP_OK);
        
        } catch (QueryException $e) {
            return response()->json([
                "message" => "Failed" . $e
            ]);
        }
    }
    
    public function pengaduanPdf(){
        $pengaduan = Pengaduan::join('masyarakats', 'pengaduans.pengadu_id', '=', 'masyarakats.user_id')
                                ->join('petugas', 'pengaduans.penanggap_id', '=', 'petugas.user_id')
                                ->select('pengaduans.*', 'masyarakats.nama AS namaPengadu', 'masyarakats.nik', 'petugas.nama AS namaPenanggap')
                                ->where('pengaduans.jenis', 'pengaduan')
                                ->get()
                                ->SortByDesc('pengaduans.created_at');
        $pdf = PDF::loadView('tanggapan.pengaduan.pdf', compact('pengaduan'))
                    ->setPaper('a4', 'landscape');
        return $pdf->stream('pengaduan.pdf');
    }

    //aspirasi
    public function aspirasi()
    {
        $aspirasi = Pengaduan::join('masyarakats', 'pengaduans.pengadu_id', '=', 'masyarakats.user_id')
                                ->select('pengaduans.*', 'masyarakats.nama AS namaPengadu', 'masyarakats.nik')
                                ->where('pengaduans.jenis', 'aspirasi')
                                ->where('pengaduans.status', 'terkirim')
                                ->get()
                                ->SortByDesc('pengaduans.created_at');
        $response = [
            'message' =>  'List aspirasi belum ditanggapi',
            'aspirasi' => $aspirasi
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function detailAspirasi($id)
    {
        $aspirasi = Pengaduan::join('masyarakats', 'pengaduans.pengadu_id', '=', 'masyarakats.user_id')
                                ->select('pengaduans.*', 'masyarakats.nama AS namaPengadu', 'masyarakats.nik')
                                ->where('pengaduans.id', $id)
                                ->get();
        $response = [
            'message' =>  'Detail aspirasi',
            'aspirasi' => $aspirasi
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function tanggapanAspirasi(Request $request, $id)
    {
        $tanggapan = Pengaduan::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'tanggapan' => ['required', 'string', 'min:10']
        ]);
        if ( $validator->fails() ) {
            return response()->json($validator->errors(), 
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $tanggapan->tanggapan = $request->tanggapan;
            $tanggapan->penanggap_id = $request->user()->id;
            $tanggapan->status = $request->status;
            $tanggapan->updated_at = now();

            $tanggapan->save();
            $response = [
                'message' => 'aspirasi ditanggapi',
                'aspirasi' => $tanggapan
            ];
            return response()->json($response, Response::HTTP_OK);
        
        } catch (QueryException $e) {
            return response()->json([
                "message" => "Failed" . $e
            ]);
        }
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
