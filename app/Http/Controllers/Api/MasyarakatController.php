<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Masyarakat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class MasyarakatController extends Controller
{
    public function index()
    {
        $mas = Masyarakat::all()
                        ->sortBy('kk')
                        ->sortBy('nik');
        $response = [
            'message' =>  'List masyarakat desa',
            'masyarakat' => $mas
        ];

        return response()->json($response, Response::HTTP_OK);
    }   

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'kk' => ['required', 'numeric', 'digits_between:15,17'],
            'nik' => ['required', 'numeric', 'digits_between:15,17', 'unique:App\Masyarakat,nik'],
            'lahir' => ['required']
        ]);
        if ( $validator->fails() ) {
            return response()->json($validator->errors(), 
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $masyarakat = new Masyarakat;
            $masyarakat->user_id = null;
            $masyarakat->nama = Str::of($request->nama)->upper();
            $masyarakat->kk = $request->kk;
            $masyarakat->nik = $request->nik;
            $masyarakat->telpon = $request->telpon;
            $masyarakat->lahir = $request->lahir;
            $masyarakat->created_at = now();
            $masyarakat->updated_at = null;
    
            $masyarakat->save();
            $response = [
                'message' => 'Masyarakat terdaftar',
                'pengaduan' => $masyarakat
            ];
            return response()->json($response, Response::HTTP_OK);
        
        } catch (QueryException $e) {
            return response()->json([
                "message" => "Failed" . $e
            ]);
        }
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
