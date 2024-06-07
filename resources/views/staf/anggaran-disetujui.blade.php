@extends('layouts.mainlayout')

@section('title', 'Anggaran Disetujui')

@section('content')
<h1 class="text-center">RENCANA LIST KEBUTUHAN ANGGARAN YANG DISETUJUI</h1>
<div class="mt-5">
    @if (session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
    @endif
  @if (Auth::user()->role_id == 4)
    <div class="row mb-3">
      <div class="col-6">
        <a href="/anggaran-disetuju-spn" class="btn btn-success position-relative"><b>PENGAJUAN ANGGARAN</b>
          @if (count($notifAnggaran) > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              !
              <span class="visually-hidden">unread messages</span>
            </span>    
          @endif
        </a>
      </div>
    </div> 
  @endif
  <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          @if (Auth::user()->role_id == 3)
            <th scope="col">SPN</th>
          @endif
          <th scope="col">JENIS DIPA</th>
          <th scope="col">PROGRAM</th>
          <th scope="col">KEGIATAN</th>
          <th scope="col">SUB KEGIATAN</th>
          <th scope="col">VOLUME</th>
          <th scope="col">HARGA SATUAN</th>
          <th scope="col">PAGU</th>
          <th scope="col">RESPON</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        @if (count($anggaran) > 0)
          @foreach ($anggaran as $item)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              @if (Auth::user()->role_id == 3)
                <td>{{ $item->spn }}</td>
              @endif
              <td>{{ $item->jenis_dipa }}</td>
              <td>{{ $item->program_kode }}</td>
              <td>{{ $item->dipa_kode }}</td>
              <td>{{ $item->kode }}-{{ $item->uraiaan }}</td>
              <td>{{ $item->volume }} {{ $item->list }}</td>
              <td>{{ number_format($item->harga_satuan, 0, '.', '.') }}</td>
              <td>{{ number_format($item->pagu, 0, '.', '.') }}</td>
              <td class="text-uppercase text-success"><b>{{ $item->respon }}</b></td>
            </tr>
          @endforeach
        @else
        <tr><td colspan="12" class="text-center">Tidak ada Data</td></tr>    
        @endif
    </table>
</div>
@endsection