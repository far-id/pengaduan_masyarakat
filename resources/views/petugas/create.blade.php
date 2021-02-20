@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/checkbox.css') }}">

@if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h5 class="title">Daftarkan Petugas Baru</h5>
    </div>
    <div class="card-body">
        <div class="container">
            <form action="{{ route('daftarPetugas') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12 pr-1 pl-1">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" value="{{ old('name') }}" name="name" autofocus tabindex="1" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 pr-1 pl-1">
                    <div class="form-group">
                        <label>Telpon</label>
                        <input type="number" class="form-control" value="{{ old('telpon') }}" name="telpon" autofocus tabindex="2" required>
                    </div>
                </div>
                <div class="col-md-6 pr-1 pl-1">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" value="{{ old('password') }}" name="password" tabindex="4" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 pr-1 pl-1">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" value="{{ old('username') }}" name="username" tabindex="3" required ma="25">
                    </div>
                </div>
                <div class="col-md-6 pr-1 pl-1">
                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" class="form-control" value="{{ old('password_confirmation') }}" name="password_confirmation" tabindex="5" required>
                    </div>
                </div>
            </div>
            
            <div class="form-check form-check-inline">
                <div class="col">
                    <label class="radio">Petugas
                    <input type="radio" checked="checked" name="radio" value="petugas">
                    <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col">
                    <label class="radio">Admin
                    <input type="radio" name="radio" value="admin">
                    <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary btn-block mt-5" tabindex="6">kirim</button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function showName() {
        let thefile = document.getElementById('customFile');
        let labelFileName = document.getElementById('fileName');
        labelFileName.innerHTML = thefile.files[0].name;
    }
</script> 
@endsection
