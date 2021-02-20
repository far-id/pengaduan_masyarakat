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
    <h2 align="center">Petugas & Admin</h2>
    <table border="1px solid" rules="all" padding="10px" width="700px">
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="13%">Terdaftar</th>
                <th width="36%">Nama</th>
                <th width="14%">Telpon</th>
                <th width="17%">Username</th>
                <th width="12%">Level</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($petugas as $p)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td class="td">{{ $p->created_at->format('d M Y') }}</td>
                    <td class="name">{{ $p->nama }}</td>
                    <td class="name">{{ $p->telpon }}</td>
                    <td class="name">{{ $p->username }}</td>
                    <td class="td">{{ $p->level }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>