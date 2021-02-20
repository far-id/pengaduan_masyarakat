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
        <h5 class="title">Tambah Masyarakat</h5>
    </div>
    <div class="card-body">
        <div class="container">
            <form action="{{ route('daftarMas') }}" method="POST" enctype="multipart/form-data">
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
                        <label>Lahir</label>
                        <input type="date" class="form-control" value="{{ old('lahir') }}" name="lahir" tabindex="2" required>
                    </div>
                </div>
                <div class="col-md-6 pr-1 pl-1">
                    <div class="form-group">
                        <label>KK</label>
                        <input type="number" class="form-control" value="{{ old('kk') }}" name="kk" tabindex="4" required minlength="15" maxlength="17">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 pr-1 pl-1">
                    <div class="form-group">
                        <label>Telpon</label>
                        <input type="number" class="form-control" value="{{ old('telpon') }}" name="telpon" tabindex="3" minlength="10" maxlength="14">
                    </div>
                </div>
                <div class="col-md-6 pr-1 pl-1">
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="number" class="form-control" value="{{ old('nik') }}" name="nik" tabindex="5" required minlength="15" maxlength="17">
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary btn-block mt-5" tabindex="6" >kirim</button>
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
