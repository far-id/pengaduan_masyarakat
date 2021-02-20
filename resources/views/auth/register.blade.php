@extends('layouts.auth')

@section('body')
@if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form class="form" method="POST" action="{{ route('regist') }}">
    @csrf
    <div class="card-header text-center">
        <h5 class="title">Pengaduan Masyarakat<br>Desa Simo</h5>
    </div>
    <div class="card-body">
        <div class="input-group no-border input-lg">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="now-ui-icons users_circle-08"></i>
                </span>
            </div>
            <input type="number" name="kk" value="{{ old('kk') }}" class="form-control" placeholder="KK" required>
        </div>
        <div class="input-group no-border input-lg">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="now-ui-icons users_circle-08"></i>
                </span>
            </div>
            <input type="number" name="nik" value="{{ old('nik') }}" class="form-control" placeholder="NIK" required>
        </div>
        <div class="input-group no-border input-lg">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="now-ui-icons users_circle-08"></i>
                </span>
            </div>
            <input type="text" name="username" value="{{ old('username') }}" class="form-control" placeholder="Username" required>
        </div>
        <div class="input-group no-border input-lg">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fas fa-key"></i>
                </span>
            </div>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="input-group no-border input-lg">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fas fa-key"></i>
                </span>
            </div>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
        </div>
        <input type="hidden" name="level" value="masyarakat">
    </div>
    <div class="card-footer text-center">
        <button type="submit" class="btn btn-primary btn-round btn-lg btn-block">DAFTAR</button>
        <div class="pull-left">
        <h6>
            <a href="/login" class="link">SUDAH PUNYA AKUN?</a>
        </h6>
        </div>
        <div class="pull-right">
        <h6>
            <a href="#" class="link">Need Help?</a>
        </h6>
        </div>
    </div>
</form>
@endsection

{{-- 
    <form action="{{ route('reg') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <input name="name" type="text" placeholder="Nama" required autofocus class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <input name="username" type="text" placeholder="Username" required autofocus class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}">
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <input name="password" type="password" placeholder="Password" required class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <input name="password_confirmation" type="password" placeholder="Konfirmasi Password" required class="form-control">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        @auth
            @if (auth()->user()->level == 'admin')
                <div class="form-group mb-3">
                        <select name="level" id="level" class="form-control custom-select">
                            <option value="" hidden selected>---Pilih Role---</option>
                            <option value="admin">admin</option>
                            <option value="petugas">petugas</option>
                        </select>
                </div>
            @endif
        @else
            <input type="hidden" name="level" value="{{ 'masyarakat' }}">
        @endauth
        <button type="submit" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm">Daftar</button>
        <div class="text-center d-flex justify-content-between mt-4">
            <a href="login" class="font-italic text-muted"> 
                Login
            </a>
        </div>
    </form>
</div> --}}