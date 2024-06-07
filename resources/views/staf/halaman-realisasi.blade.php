@extends('layouts.mainlayout')

@section('title', 'Halaman Anggaran')

@section('content')
<h1 class="text-center">RENCANA LIST KEBUTUHAN ANGGARAN</h1>
<div class="mt-5">
  <div class="row mb-3">
    <div class="col-6 mb-3">
      <a href="/anggaran-diajukan" class="btn btn-secondary position-relative"><b>AJUKAN</b>
        @if (count($ajukan) > 0)
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            +1
            <span class="visually-hidden">unread messages</span>
          </span>  
        @endif
      </a>
      <a href="/anggaran-disetujui" class="btn btn-info ms-3 position-relative"><b>SETUJU</b>
        @if (count($setuju) > 0)
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            +1
            <span class="visually-hidden">unread messages</span>
          </span>  
        @endif
      </a>
      {{-- <a href="/anggaran-direalisasikan" class="btn btn-success ms-3 position-relative"><b>REALISASI</b>
        @if (count($realisasi) > 0)
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            +1
            <span class="visually-hidden">unread messages</span>
          </span>  
        @endif
      </a> --}}
    </div>
    <div class="col-6 text-end">
      <a href="/Staf_add_kebutuhan_anggaran" class="btn btn-primary"><b>TAMBAH</b></a>
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
            <th scope="col">JENIS DIPA</th> 
            <th scope="col">PROGRAM</th>
            <th scope="col">KEGIATAN</th>
            <th scope="col">SUB KEGIATAN</th>
            <th scope="col">VOLUME</th>
            <th scope="col">HARGA SATUAN</th>
            <th scope="col">PAGU</th>
            <th scope="col">REALISASI</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          @if (count($laporan) > 0)
            @foreach ($laporan as $item)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $item->jenis_dipa }}</td>
                <td>{{ $item->program_kegiatan }}</td>
                <td>{{ $item->dipa_kegiatan }}</td>
                <td>{{ $item->kode_kegiatan }}-{{ $item->uraian_kegiatan }}</td>
                <td>{{ $item->volume }} {{ $item->list }}</td>
                <td>{{ number_format($item->harga_satuan, 0, '.', '.') }}</td>
                <td>{{ number_format($item->pagu, 0, '.', '.') }}</td>
                <td>{{ number_format($item->realisasi, 0, '.', '.') }}</td>
              </tr>
            @endforeach
          @else 
          <tr><td colspan="12" class="text-center">Tidak ada Data</td></tr>   
          @endif
      </table>
</div>
@endsection