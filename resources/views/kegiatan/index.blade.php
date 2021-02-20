@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between bd-highlight">
                <div class="p-2 bd-highlight">
                    <h5 class="title">Kegiatan Buatanmu</h5>
                </div>
                <div class="p-2 bd-highlight">
                </div>
                <div class="p-2 bd-highlight">
                    <a href="{{ route('tambahKegiatan') }}">Tambah</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3">
        @forelse ($kegiatan as $k)
        @php
            $gambar = json_decode($k->gambar);
        @endphp
            <div class="col mb-4">
                <div class="card h-100">
                    <a type="button" data-toggle="modal" data-target="#kegiatan{{ $loop->iteration }}">
                        @foreach ((array) $gambar as $g)
                        <div style="height: 200px;">
                            <img src="{{ asset('img/kegiatan/' . $g) }}" class="card-img-top mh-100" alt="">
                        </div>
                        @endforeach
                    </a>
                    <div class="card-body">
                        <h4 class="card-title mt-0">{{ $k->judul }}</h4>
                        <p class="card-text">{{ $k->kegiatan }}</p>
                        <div class="d-flex bd-highlight">
                            <div class="p-2 flex-fill bd-highlight"><p class="card-text"><small class="text-muted">{{ $k->created_at->diffForHumans() }}</small></p></div>
                            <div class="p-2 flex-fill bd-highlight"></div>
                            <div class="p-2 flex-fill bd-highlight"><a href="{{ route('hapusKegiatan', ['id' => $k->id]) }}" class="text-danger"><i class="fas fa-trash d-flex justifity-content-end"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>


        @empty
            
        @endforelse
    </div>
    @forelse ($kegiatan as $k)
    @php
        $gambar = json_decode($k->gambar);
    @endphp
    <div class="modal fade" id="kegiatan{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach ((array) $gambar as $g)
                        <img src="{{ asset('img/kegiatan/' . $g) }}" class="card-img-top mh-100" alt="">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @empty
        
    @endforelse


@endsection
