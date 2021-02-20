@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="title">Profil</h5>
    </div>
    <div class="card-body">
        @foreach ($profil as $p)
            <form action="{{ route('editProfileP', ['id' => $p->id]) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-9 pr-1">
                        <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" disabled placeholder="{{ $p->username }}">
                        </div>
                    </div>
                        
                    <div class="col-md-3 pl-1">
                        <div class="form-group">
                        <label>Telpon</label>
                        <input type="number" class="form-control" placeholder="08" value="{{ $p->telpon }}" name="telpon" minlength="11" maxlength="13">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 pr-1">
                        <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" disabled placeholder="{{ $p->nama }}">
                        </div>
                    </div>
                    <div class="col-md-2 pl-1">
                        <div class="form-group">
                        <label>level</label>
                        <input type="text" class="form-control" disabled placeholder="{{ $p->level }}">
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-block">Edit</button>
            </form>
        @endforeach
        
    </div>
</div>
@endsection