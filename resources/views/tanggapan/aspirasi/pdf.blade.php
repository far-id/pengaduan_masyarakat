<!DOCTYPE html>
<head>
    <title>pdf</title>
    <style type="text/css">
        table{
            width: 100%;
            font-size: 10pt;
        }
        .name{
            padding-left: 6px
        }
        .td{
            text-align: center;
        }
        img{
            width: 100px;
            margin: 10px;
        }
        </style>
</head>
<body>
    <h2 align="center">Pengaduan</h2>
    <table border="1px solid" rules="all" padding="10px" width="1000px">
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="7%">Tanggal</th>
                <th width="10%">Pengirim</th>
                <th width="30%">Pengaduan</th>
                <th width="11%">Foto</th>
                <th width="26%">Tanggapan</th>
                <th width="8%">Penanggap</th>
                <th width="7%">Pada</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($aspirasi as $pe)
                @php
                    $bukti = json_decode($pe->gambar) ;

                    if ( $pe->updated_at == null ){
                        $ditanggapi = "";
                    }else {
                        $ditanggapi = $pe->updated_at->format('d M Y');
                    }
                @endphp
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td class="td">{{ $pe->created_at->format('d M Y') }}</td>
                    <td class="name">{{ $pe->namaPengaspi }}<br>({{ $pe->nik }})</td>
                    <td class="name">{!! nl2br($pe->aduan) !!}</td>
                    <td class="td">@foreach((array) $bukti as $img)
                        <img src="{{ public_path('img/pengaduan/' . $img) }}" alt="foto">
                        @endforeach
                    </td>
                    <td class="name">{!! nl2br($pe->tanggapan) !!}</td>
                    <td class="name">{{ $pe->namaPenanggap }}</td>
                    <td class="td">{{ $ditanggapi }}</td>
                </tr>
            @empty
                <td colspan="8">Tidak Ada Data</td>
            @endforelse
        </tbody>
    </table>
</body>
</html>