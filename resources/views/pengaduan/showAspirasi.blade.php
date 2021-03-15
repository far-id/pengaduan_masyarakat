@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/checkbox.css') }}">

@section('content')
    <div class="row">
        <div class="col md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Detail</h5>
                    <div class="card-body">
                        @foreach ($aspirasi as $as)
                        @php
                            $bukti = json_decode($as->gambar) ;
                            
                            if ( $as->status == 'diterima' ) {
                                $diterima =  "checked=''";
                                $ditolak = null;
                                $terkirim = null;
                            } elseif ( $as->status == 'ditolak' ) {
                                $diterima =  null;
                                $ditolak = "checked=''";
                                $terkirim = null;
                            } else {
                                $diterima =  null;
                                $ditolak = null;
                                $terkirim = "checked=''";
                            }
                            
                        @endphp
                                @csrf
                                <div class="form-group">
                                    <label>Tanggal Dikirim</label>
                                    <input type="text" class="form-control" disabled value="{{ $as->created_at }}">
                                </div>
                                <div class="form-group">
                                    <label>Aspirasi</label>
                                    <textarea rows="3" name="aduan" disabled class="form-control" required autofocus minlength="30">{{ $as->aduan }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Ditanggapi</label>
                                    <input type="text" class="form-control" disabled value="@forelse ($penanggap as $pen){{ $pen->nama }}@empty Belum Ditanggapi @endforelse"/>
                                </div>
                                <div class="form-group">
                                    <label>Tanggapan</label>
                                    <textarea rows="3" name="aduan" disabled class="form-control" required autofocus minlength="30">{{ $as->tanggapan }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Ditanggapi</label>
                                    <input type="text" class="form-control" disabled value="{{ $as->updated_at }}">
                                </div>

                                <div class="form-check form-check-inline">
                                    <div class="col">
                                        <label class="radio">terkirim
                                            <input type="radio" {{ $terkirim }} name="radio" value="terkirim" disabled>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="col">
                                        <label class="radio">diterima
                                            <input type="radio" {{ $diterima }} name="radio" value="diterima" disabled>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="col">
                                        <label class="radio">ditolak
                                            <input type="radio" {{ $ditolak }} name="radio" value="ditolak" disabled>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>

                                </div>
                                <a href="{{ url()->previous() }}" class="btn btn-primary btn-block mt-5">Kembali</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Foto</h5>
                </div>
                <div class="card-body">
                    @foreach((array) $bukti as $img)
                        <img src="{{ asset('img/pengaduan/' . $img) }}" alt="foto">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection