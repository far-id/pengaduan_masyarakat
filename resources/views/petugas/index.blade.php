@extends('layouts.app')

@php
  $judul = ['No', 'Terdaftar','Nama', 'telpon', 'Username', 'Level'];
@endphp

@section('content')
<div class="card">
  <div class="card-header">
    <div class="d-flex justify-content-between bd-highlight">
      <div class="p-2 bd-highlight">
        <h5 class="title">Petugas</h5>
      </div>
      <div class="p-2 bd-highlight">
      </div>
      <div class="p-2 bd-highlight">
        <a href="{{ route('petugasPdf') }}">PDF</a>
        |<a href="{{ route('tambahPetugas') }}">Tambah</a>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="table-wrapper table-responsive-md w-auto">
      <table id="dataTable" class="table table-hover">
        <thead>
          <tr>
            @foreach ($judul as $j)
              <th class="">
                <a>{{$j}}
                </a>
              </th>
            @endforeach
          </tr>
        </thead>
        <tbody>
          @foreach ($petugas as $p)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{ $p->created_at->format('d M Y') }}</td>
              <td>{{ $p->nama}}</td>
              <td>{{ $p->telpon}}</td>
              <td>{{ $p->username}}</td>
              <td>{{ $p->level }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<script>
    $(document).ready(function(){
        $('#dataTable').DataTable();
    });
</script>
@endsection

