@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="title">Profil</h5>
    </div>
    <div class="card-body">
        @foreach ($profil as $p)
            <form action="{{ route('editProfileM', ['id' => $p->id]) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 pr-1">
                        <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" disabled placeholder="{{ $p->username }}">
                        </div>
                    </div>
                    <div class="col-md-3 px-1">
                        <div class="form-group">
                        <label>NIK</label>
                        <input type="number" class="form-control" disabled placeholder="{{ $p->nik }}">
                        </div>
                    </div>
                    <div class="col-md-3 pl-1">
                        <div class="form-group">
                        <label>KK</label>
                        <input type="number" class="form-control" disabled placeholder="{{ $p->kk }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" disabled placeholder="{{ $p->nama }}">
                        </div>
                    </div>
                    <div class="col-md-2 pl-1">
                        <div class="form-group">
                        <label>Telpon</label>
                        <input type="number" class="form-control" placeholder="08" value="{{ $p->telpon }}" name="telpon" minlength="11" maxlength="13">
                        </div>
                    </div>
                    <div class="col-md-3 pl-1">
                        <div class="form-group">
                        <label>Lahir</label>
                        <input type="text" class="form-control" disabled placeholder="{{ $p->lahir->isoFormat('dddd, D MMMM Y') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                        <label>Alamat</label>
                        <textarea rows="4" cols="80" class="form-control" placeholder="Lengkapi alamatmu" name="alamat">{{ $p->alamat }}</textarea>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-block">Edit</button>
            </form>
        @endforeach
        
    </div>
</div>
@endsection