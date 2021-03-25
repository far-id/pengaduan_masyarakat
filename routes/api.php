<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', function(Request $request){
	$data = $request->validate([
		'username'	=> 'required',
		'password' => 'required'
	]);

	$user = App\User::where('username', $request->username)->first();

    if (! $user || !Hash::check($request->password, $user->password)) {
        return response([
            'username' => ['The provided credentials are incorrect.'],
        ], 404);
    }

    return $user->createToken('my-token')->plainTextToken;

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('auth:sanctum')->get('/logout', function (Request $request) {
//     $user = request()->user();
//     $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
//     return $request->user();
// });

Route::get('dashboard', 'Api\HomeController@index');
// Route::get('kegiatan', 'Api\KegiatanController@index');

Route::middleware('auth:sanctum')->group(function() {

    //logout
    Route::get('/logout', function (Request $request) {
        $user = request()->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        return $request->user();
    });
    //admin & petugas
    Route::group(['middleware' => "petugas"], function () {
        Route::get('/masyarakat/pengaduan/pdf', 'Api\TanggapanController@pengaduanPdf');
        Route::get('/masyarakat/pengaduan', 'Api\TanggapanController@index');
        Route::get('/masyarakat/pengaduan/{id}', 'Api\TanggapanController@show');
        Route::post('/masyarakat/pengaduan/{id}', 'Api\TanggapanController@tanggapan');

        Route::get('/masyarakat/aspirasi/pdf', 'TanggapanController@aspirasiPdf');
        Route::get('/masyarakat/aspirasi', 'Api\TanggapanController@aspirasi');
        Route::get('/masyarakat/aspirasi/{id}', 'Api\TanggapanController@detailAspirasi');
        Route::post('/masyarakat/aspirasi/{id}', 'Api\TanggapanController@tanggapanAspirasi');

        Route::get('/masyarakat/pdf', 'Api\MasyarakatController@pdf');
        Route::get('/masyarakat', 'Api\MasyarakatController@index');
        Route::post('/masyarakat', 'Api\MasyarakatController@store');

        Route::get('kegiatan', 'Api\KegiatanController@index');
        Route::post('kegiatan', 'Api\KegiatanController@store');
        Route::delete('kegiatan/{id}', 'Api\KegiatanController@destroy');
    });
    
    //admin
    Route::group(['middleware' => "admin"], function () {
        Route::get('/petugas/pdf', 'PetugasController@pdf')->name('petugasPdf');
        Route::get('/petugas', 'PetugasController@index');
        Route::get('/petugas/tambah', 'PetugasController@create')->name('tambahPetugas');
        Route::post('/petugas/tambah', 'PetugasController@store')->name('daftarPetugas');
    });

    //masyarakat
    Route::group(['middleware' => "masyarakat"], function () {
        Route::get('/aspirasi', 'Api\PengaduanController@aspirasi');
        Route::get('/aspirasi/detail/{id}', 'Api\PengaduanController@showAspirasi');
        Route::get('/pengaduan', 'Api\PengaduanController@index');
        Route::get('/pengaduan/detail/{id}', 'Api\PengaduanController@showPengaduan');
        Route::post('/pengaduan', 'Api\PengaduanController@store');
    });
});