<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Kegiatan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->level == "admin")
        {
            $kegiatan = Kegiatan::all()
                                ->SortByDesc('created_at');
            $response = [
                'message' =>  'List Kegiatan ',
                'data' => $kegiatan,
            ];
            // return response()->json($response, Response::HTTP_OK);
        }
        else{
            $kegiatan = Kegiatan::where('user_id',Auth()->id())
                            ->get()
                            ->SortByDesc('created_at');
            $response = [
                'message' =>  'List Kegiatan ',
                'data' => $kegiatan,
            ];
        }
        

        return response()->json($response, Response::HTTP_OK);
    }

    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => ['required', 'string'],
            'kegiatan' => ['required', 'string'],
            'img.*' => ['image', 'mimes:jpeg,png,jpg|max:2048'],
        ]);

        if ( $validator->fails() ) {
            return response()->json($validator->errors(), 
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }

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

        try {
            $kegiatan = new Kegiatan();
            $kegiatan->user_id = $request->user()->id;
            $kegiatan->judul = $request->judul;
            $kegiatan->kegiatan = $request->kegiatan;
            $kegiatan->gambar = $gambar;
            $kegiatan->created_at = now();
            $kegiatan->updated_at = null;
            $kegiatan->save();

            $response = [
                'message' => 'kegiatan created',
                'data' => $kegiatan
            ];
            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                "message" => "Failed" . $e
            ]);
        }

    }

    public function destroy($id)
    {
        // Kegiatan::destroy($id);
        // return redirect('/kegiatan')->with(['success' => 'Kegiatan dihapus']);

        $kegiatan = kegiatan::findOrFail($id);

        try {
            $kegiatan->delete();
            $response = [
                'message' => 'kegiatan deleted',
            ];
            return response()->json($response, Response::HTTP_OK);
        
        } catch (QueryException $e) {
            return response()->json([
                "message" => "Failed" . $e
            ]);
        }
    }
}
