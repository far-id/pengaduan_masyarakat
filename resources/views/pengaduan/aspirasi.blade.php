@extends('layouts.app')

@php
    $judul = ['No', 'Tanggal', 'Pengaduan', 'Status', 'Tanggapan'];
@endphp

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between bd-highlight">
            <h5 class="title">Pengaduan Saya</h5>
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
            @foreach ($aspirasi as $as)
                <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$as->created_at->format('d M Y')}}</td>
                <td>{{$as->aduan}}</td>
                <td>{{$as->status}}</td>
                <td>
                    <form action="/aspirasi/detail/{{ $as->id }}" method="get">
                    <button type="submit" class="btn btn-success">Lihat Tanggapan
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

