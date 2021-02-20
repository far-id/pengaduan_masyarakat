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
        <h5 class="title">Adakan Kegiatan</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('buatKegiatan') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label>Nama Kegiatan</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" placeholder="Kegiatan apa yang akan diadakan?" required autofocus>
            </div>

            <div class="form-group">
                <label>Kegiatan</label>
                <textarea rows="3" name="kegiatan" class="form-control" value="{{ old('kegiatan') }}" placeholder="Perjelas kegiatan disini!" required>{{ old('kegiatan') }}</textarea>
            </div>

            <div class="form-group">
                <label>Foto/Poster</label>
                <input type="file" id="customFile" class="custom-file-input" aria-describedby="inputGroupFileAddon01" onchange="showName()" name="img[]" multiple>
                <label class="custom-file-label mt-4" for="customFile" id="fileName" style="border-radius: 40px;">Klik untuk mencari poster</label>
            </div>
            
            <p class="card-text text-center mt-5"><small class="text-muted">Kegiatan yang dibuat akan tampil di halaman dashboard semua orang</small></p>
            <button type="submit" class="btn btn-primary btn-block">Buat</button>
        </form>
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
