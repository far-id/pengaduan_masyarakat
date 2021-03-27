<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::view('/', 'Auth/login');

Auth::routes();
Route::post('/regist', 'Auth\RegisterController@regist')->name('regist');
Route::post('/login', 'Auth\LoginController@login')->name('masuk');

Route::view('tes', 'tes');
    
Route::middleware('auth')->group(function() {
    //semua
    Route::get('/dashboard', 'HomeController@index')->name('home');
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::post('/profile/edit/M/{id}', 'ProfileController@updateM')->name('editProfileM');
    Route::post('/profile/editP//{id}', 'ProfileController@updateP')->name('editProfileP');

    //admin & petugas
    Route::group(['middleware' => "petugas"], function () {
        Route::get('/masyarakat/pengaduan/pdf', 'TanggapanController@pengaduanPdf')->name('pengaduanPdf');
        Route::get('/masyarakat/pengaduan', 'TanggapanController@index');
        Route::get('/masyarakat/pengaduan/{id}', 'TanggapanController@show');
        Route::post('/masyarakat/pengaduan/{id}/tanggapi', 'TanggapanController@tanggapan')->name('tanggapi');
        
        Route::get('/masyarakat/aspirasi/pdf', 'TanggapanController@aspirasiPdf')->name('aspirasiPdf');
        Route::get('/masyarakat/aspirasi', 'TanggapanController@aspirasi');
        Route::get('/masyarakat/aspirasi/{id}', 'TanggapanController@detailAspirasi');
        Route::post('/masyarakat/aspirasi/{id}/tanggapi', 'TanggapanController@tanggapanAspirasi')->name('tanggapiAspi');
        
        Route::get('/masyarakat/pdf', 'MasyarakatController@pdf')->name('masPdf');
        Route::get('/masyarakat', 'MasyarakatController@index');
        Route::get('/masyarakat/tambah', 'MasyarakatController@create')->name('tambahMas');
        Route::post('/masyarakat/tambah', 'MasyarakatController@store')->name('daftarMas');
        
        Route::get('/kegiatan', 'KegiatanController@index');
        Route::get('/kegiatan/tambah', 'KegiatanController@create')->name('tambahKegiatan');
        Route::post('/kegiatan/tambah', 'KegiatanController@store')->name('buatKegiatan');
        Route::get('/kegiatan/hapus/{id}', 'KegiatanController@destroy')->name('hapusKegiatan');

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
        Route::get('/aspirasi', 'PengaduanController@aspirasi');
        Route::get('/aspirasi/detail/{id}', 'PengaduanController@showAspirasi');
        Route::get('/pengaduan', 'PengaduanController@index');
        Route::get('/pengaduan/create', 'PengaduanController@create');
        Route::get('/pengaduan/detail/{id}', 'PengaduanController@showPengaduan');
        Route::post('/pengaduan', 'PengaduanController@store')->name('kirimPengaduan');
    });
});







// Route::middleware(['auth', 'admin'])->group(function () {}


