@extends('layouts.mainlayout')

@section('title', 'Laporan Anggaran')

@section('content')
<h1 class="text-center">LAPORAN REKAP REALISASI ANGGARAN</h1>
<div class="mt-5">
    <div class="row mb-3">
        <div class="col-6">
            <form action="" method="get">
                <div class="col-8 d-flex">
                    <select name="unit" class="form-select me-2 btn-outline-primary" aria-label="Default select example" id="unit">
                         <option selected disabled>UNIT</option>
                        @foreach ($staf as $item)
                            <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                    <select name="bulan" class="form-select me-2 btn-outline-primary" aria-label="Default select example">
                        <option selected disabled>BULAN</option>
                        <option value="januari">Januari</option>
                        <option value="februari">Februari</option>
                        <option value="maret">Maret</option>
                        <option value="april">April</option>
                        <option value="mei">Mei</option>
                        <option value="juni">Juni</option>
                        <option value="juli">Juli</option>
                        <option value="agustus">Agustus</option>
                        <option value="september">September</option>
                        <option value="oktober">Oktober</option>
                        <option value="november">November</option>
                        <option value="desember">Desember</option>
                    </select>
                    <select name="tahun" class="form-select btn-outline-primary" aria-label="Default select example">
                        <option selected disabled>TAHUN</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                    </select>
                    <button type="submit" class="btn btn-primary ms-2">Cari</button>
                </div>    
            </form>
        </div>
        <div class="col-6 text-end">
        @if (Auth::user()->role_id == 4)
            <a href="unduh-excel" class="btn btn-primary ms-auto"><b>EXCEL</b></a>
            <a href="print-laporan" target="_blank" class="btn btn-info"><b>CETAK</b></a>
        @else    
            <a href="cetak-excel" class="btn btn-primary ms-auto"><b>EXCEL</b></a>
            <a href="cetak-laporan" target="_blank" class="btn btn-info"><b>CETAK</b></a>
        @endif
        </div>
    </div>
    @if (session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
    @endif
    <table class="table">
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
            @if (Auth::user()->role_id == 2)
                <th scope="col">AKSI</th>
            @endif
          </tr>
        </thead>
        <tbody class="table-group-divider">
            @if (count($laporan) > 0)
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
                    @if (Auth::user()->role_id == 2)
                        <td>
                            <a href="/laporan-delete/{{ $item->staf }}" onclick="return confirm('Apakah anda yakin ingin menghapus data {{ $item->jenis_dipa }} ?')" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a>
                        </td>
                    @endif
                </tr>
                @endforeach
                <tr>
                    <th colspan="9">TOTAL PENGGUNAAN DANA<th>{{ number_format($jumlah, 0, '.', '.') }}</th><th></th></th>
                </tr>
            @else
            <tr><td colspan="12" class="text-center">Tidak ada Data</td></tr>    
            @endif
        </tbody>    
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myButton').on('click', function() {
            var data = {
                key1: 'nilai1',
                key2: 'nilai2',
                key3: 'nilai3'
            };

            $.ajax({
                url: '/url_controller',
                type: 'POST',
                data: data,
                success: function(response) {
                    // Proses respons dari fungsi controller
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Tangani kesalahan jika terjadi
                    console.log(error);
                }
            });
        });
    });
</script>

@endsection