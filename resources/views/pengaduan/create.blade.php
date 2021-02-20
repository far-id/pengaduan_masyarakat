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
    <h5 class="title">Form Pengaduan</h5>
  </div>
  <div class="card-body">
    <form action="{{ route('kirimPengaduan') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label>Pengaduan</label>
        <textarea rows="3" name="aduan" class="form-control" value="{{ old('aduan') }}" placeholder="Ketik pengaduanmu disini" required autofocus minlength="30">{{ old('aduan') }}</textarea>
      </div>

      <div class="form-group">
        <label>Foto Bukti</label>
        <input type="file" id="customFile" class="custom-file-input" aria-describedby="inputGroupFileAddon01" onchange="showName()" name="img[]" multiple>
        <label class="custom-file-label mt-4" for="customFile" id="fileName" style="border-radius: 40px;">Klik untuk mencari gambar</label>
      </div>
      
      <div class="mt-5">
        <div class="form-check form-check-inline">
          <div class="col">
            <label class="radio">Pengaduan
              <input type="radio" checked="checked" name="radio" value="pengaduan">
              <span class="checkmark"></span>
            </label>
          </div>
          <div class="col">
            <label class="radio">Aspirasi
              <input type="radio" name="radio" value="aspirasi">
              <span class="checkmark"></span>
            </label>
          </div>
      </div>
      
      <button type="submit" class="btn btn-primary btn-block mt-5">kirim</button>
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
