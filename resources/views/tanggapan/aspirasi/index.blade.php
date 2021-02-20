@extends('layouts.app')

@php
    $judul = ['No','Nama','Aspirasi','Tanggal','Action'];
@endphp

@section('content')
<div class="card">
  <div class="card-header">
    <div class="d-flex justify-content-between bd-highlight">
      <div class="p-2 bd-highlight">
        <h5 class="title">Aspirasi Masyarakat</h5>
      </div>
      <div class="p-2 bd-highlight">
      </div>
      <div class="p-2 bd-highlight">
        <a href="{{ route('aspirasiPdf') }}">PDF</a>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="table-wrapper table-responsive-md w-auto">
      <table id="dataTable" class="table table-hover table-bordered">
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
          @foreach ($pengaduan as $p)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$p->namaPengadu}}</td>
              <td>{{$p->aduan}}</td>
              <td>{{$p->created_at}}</td>
              <td>
                <form action="/masyarakat/aspirasi/{{ $p->id }}" method="get">
                  <button type="submit" class="btn btn-success">
                          <i class="now-ui-icons ui-2_settings-90">Detail</i>
                  </button>
                </form>
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

