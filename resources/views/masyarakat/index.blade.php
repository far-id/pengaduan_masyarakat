@extends('layouts.app')

@php
    $judul = ['No', 'KK','NIk', 'nama', 'Telpon', 'Lahir'];
@endphp

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between bd-highlight">
            <div class="p-2 bd-highlight">
                <h5 class="title">Masyarakat</h5>
            </div>
            <div class="p-2 bd-highlight">
            </div>
            <div class="p-2 bd-highlight">
                <a href="{{ route('masPdf') }}">PDF</a>
                |<a href="{{ route('tambahMas') }}">Tambah</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-wrapper table-responsive-md w-auto">
            <table id="dataTable" class="table table-striped table-bordered"  style="width:100%">
                <thead>
                <tr>
                    @foreach ($judul as $j)
                        <th>
                            <a>{{$j}}</a>
                        </th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                    @foreach ($mas as $m)
                        <tr>
                            <th>{{$loop->iteration}}</th>
                            <td>{{ $m->kk }}</td>
                            <td>{{ $m->nik }}</td>
                            <td>{{ $m->nama }}</td>
                            <td>{{ $m->telpon }}</td>
                            <td>{{ $m->lahir }}</td>
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

