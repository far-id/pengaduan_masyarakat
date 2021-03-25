<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Pengaduan;
use App\Petugas;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $pengaduan = Pengaduan::where('pengadu_id', $request->user()->id)
                                ->get()
                                ->SortByDesc('created_at')
                                ->where('jenis', 'pengaduan');
        $response = [
            'message' =>  'List transaction order by time',
            'pengaduan' => $pengaduan
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'aduan' => ['required', 'string', 'min:30'],
            'img.*' => ['image', 'mimes:jpeg,png,jpg|max:2048'],
        ]);

        if ( $validator->fails() ) {
            return response()->json($validator->errors(), 
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }

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

        try {
            $pengaduan = new Pengaduan();
            $pengaduan->aduan = $request->aduan;
            $pengaduan->gambar = $gambar;
            $pengaduan->pengadu_id = $request->user()->id;
            $pengaduan->tanggapan = '';
            $pengaduan->penanggap_id = null;
            $pengaduan->status = 'terkirim';
            $pengaduan->jenis = $request->jenis;
            // $pengaduan->created_at = now();
            $pengaduan->created_at = now();
            $pengaduan->updated_at = null;

            $pengaduan->save();
            $response = [
                'message' => 'transaction created',
                'pengaduan' => $pengaduan
            ];
            return response()->json($response, Response::HTTP_CREATED);
        
        } catch (QueryException $e) {
            return response()->json([
                "message" => "Failed" . $e
            ]);
        }
        
    }

    public function showPengaduan($id)
    {
        $pengaduan = Pengaduan::where('pengaduans.id', $id)
                                ->get();
        $penanggap = Petugas::where('user_id', $pengaduan[0]['penanggap_id'])->get();
        $response = [
            'message' => 'transaction created',
            'pengaduan' => $pengaduan,
            'penanggap' => $penanggap
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function aspirasi(Request $request)
    {
        $aspirasi = Pengaduan::where('pengadu_id', $request->user()->id)
                                ->where('jenis', 'aspirasi')
                                ->get()
                                ->SortByDesc('created_at');
        $response = [
            'message' =>  'List transaction order by time',
            'aspirasi' => $aspirasi
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function showAspirasi($id)
    {
        $aspirasi = Pengaduan::where('pengaduans.id', $id)
                                ->get();
        $penanggap = Petugas::where('user_id', $aspirasi[0]['penanggap_id'])->get();
        $response = [
            'message' => 'transaction created',
            'pengaduan' => $aspirasi,
            'penanggap' => $penanggap
        ];

        return response()->json($response, Response::HTTP_OK);
    }
}
