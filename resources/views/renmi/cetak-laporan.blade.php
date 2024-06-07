<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        table.static {
            position: relative;
            border: 1px solid #543535
        }
        .form-group p{
            font-size: 30px;
        }
    </style>
    <title>LAPORAN PENGELUARAN</title>
</head>
<body>
    <div class="form-group">
        <p align="center">Laporan Pengeluaran</p>
        <table class="static" align="center" rules="all" border="1px" style="width: 95%">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">STAF</th>
            <th scope="col">JENIS DIPA</th>
            <th scope="col">PROGRAM KEGIATAN</th>
            <th scope="col">KEGIATAN</th>
            <th scope="col">SUB KEGIATAN</th>
            <th scope="col">VOLUME</th>
            <th scope="col">HARGA SATUAN</th>
            <th scope="col">PAGU</th>
            <th scope="col">REALISASI</th>
            {{-- <th scope="col">SISA ANGGARAN</th> --}}
            <th scope="col">TANGGAL</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($laporan as $item)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $item->staf }}</td>
                <td>{{ $item->jenis_dipa }}</td>
                <td>{{ $item->program_kegiatan }}</td>
                <td>{{ $item->dipa_kegiatan }}</td>
                <td>{{ $item->kegiatan_kode }}-{{ $item->uraian_kegiatan }}</td>
                <td>{{ $item->volume }} {{ $item->list }}</td>
                <td>{{ number_format($item->harga_satuan, 0, '.', '.') }}</td>
                <td>{{ number_format($item->pagu, 0, '.', '.') }}</td>
                <td>{{ number_format($item->realisasi, 0, '.', '.') }}</td>
                {{-- <td>{{ number_format($item->sisa_anggaran, 0, '.', '.') }}</td> --}}
                <td>{{ $item->tanggal }} {{ $item->bulan }} {{ $item->tahun }}</td>
            </tr>
            @endforeach
            <tr align="left">
                <th colspan="9">TOTAL PENGGUNAAN DANA<th>{{ number_format($jumlah, 0, '.', '.') }}</th><th></th></th>
            </tr>
        </table>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>