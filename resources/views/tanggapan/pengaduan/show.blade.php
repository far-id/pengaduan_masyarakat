@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/checkbox.css') }}">

@section('content')
{{-- <div class="card-header">
    <h5 class="title">Pengaduan Masyarakat</h5>
</div> --}}
    <div class="row">
        <div class="col md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Detail</h5>
                    <div class="card-body">
                        @foreach ($pengaduan as $p)
                        @php
                            $bukti = json_decode($p->gambar) ;
                        @endphp
                            <form action="{{ route('tanggapi', $p->id) }}" method="post">
                                @csrf
                                <label>Nama</label>
                                <input type="text" class="form-control" disabled value="{{ $p->namaPengadu }}">
                                <label>NIK</label>
                                <input type="text" class="form-control" disabled value="{{ $p->nik }}">
                                <label>Tanggal</label>
                                <input type="text" class="form-control" disabled value="{{ $p->created_at }}">
                                <div class="form-group">
                                    <label>Pengaduan</label>
                                    <textarea rows="3" name="aduan" disabled class="form-control" required autofocus minlength="30">{{ $p->aduan }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="tanggapan">Tanggapan</label>
                                    <textarea id="tanggapan" rows="3" name="tanggapan" class="form-control" value="{{ old('tanggapan') }}" placeholder="Ketik tanggapanmu disini" required autofocus minlength="10">{{ old('aduan') }}</textarea>
                                </div>
                                <div class="form-check form-check-inline">
                                    <div class="col">
                                        <label class="radio">proses
                                            <input type="radio" checked="checked" name="radio" value="proses">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="col">
                                        <label class="radio">selesai
                                            <input type="radio" name="radio" value="selesai">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block mt-5">Tanggapi</button>
                            </form> 
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