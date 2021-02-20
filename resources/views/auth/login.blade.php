@extends('layouts.auth')

@section('body')
<form class="form" action="{{ route('masuk') }}" method="POST">
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
            <input type="text" name="username" class="form-control" placeholder="Username..."  required autofocus>
        </div>
        <div class="input-group no-border input-lg">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-key"></i>
                </span>
            </div>
            <input type="password" name="password" class="form-control" placeholder="Password..." required>
        </div>
    </div>
    <div class="card-footer text-center">
        <button type="submit" class="btn btn-primary btn-round btn-lg btn-block">LOGIN</button>
        <div class="pull-left">
        <h6>
            <a href="/register" class="link">BELUM PUNYA AKUN?</a>
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