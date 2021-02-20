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
        </style>
</head>
<body>
    <h2 align="center">Masyarakat</h2>
    <table border="1px solid" rules="all" padding="10px" width="700px">
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="18%">KK</th>
                <th width="18%">NIK</th>
                <th width="26%">Nama</th>
                <th width="13%">Username</th>
                <th width="13%">Telpon</th>
                <th width="10%">Lahir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($masyarakat as $m)
                <tr>
                    <th>{{ $loop->iteration }}</th> 
                    <td class="td">{{ $m->kk }}</td>
                    <td class="td">{{ $m->nik }}</td>
                    <td class="name">{{ $m->nama }}</td>
                    <td class="name">
                        @foreach ($mas as $ma)
                            @if ( $m->user_id == $ma->userid )
                                {{ $ma->username }}
                            @else
                                
                            @endif
                        @endforeach
                    </td>
                    <td class="td">{{ $m->telpon }}</td>
                    <td class="td">{{ $m->lahir }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>