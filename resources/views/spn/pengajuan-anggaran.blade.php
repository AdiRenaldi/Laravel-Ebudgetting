@extends('layouts.mainlayout')

@section('title', 'Spn Anggaran')

@section('content')
<h1 class="text-center">PENGAJUAN KEBUTUHAN ANGGARAN</h1>
<div class="mt-5">
    @if (session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
    @endif
    @if (session('warning'))
      <div class="alert alert-success">
          {{ session('warning') }}
      </div>
    @endif
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">DIPA</th>
            <th scope="col">PROGRAM KEGIATAN</th>
            <th scope="col">KEGIATAN</th>
            <th scope="col">URAIAN KEGIATAN</th>
            <th scope="col">VOLUME</th>
            <th scope="col">HARGA SATUAN</th>
            <th scope="col">PAGU</th> 
            <th scope="col">RESPON</th> 
            <th scope="col">CATATAN</th> 
            <th scope="col">REVISI</th> 
            <th scope="col">AKSI</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          @if (count($anggaran) > 0)
            @foreach ($anggaran as $item)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $item->jenis_dipa }}</td>
                <td>{{ $item->program_kode }}</td>
                <td>{{ $item->dipa_kode }}</td>
                <td>{{ $item->kode }}-{{ $item->uraiaan }}</td>
                <td>{{ $item->volume }}</td>
                <td>{{ number_format($item->harga_satuan, 0, '.', '.') }}</td>
                <td>{{ number_format($item->pagu, 0, '.', '.') }}</td>
                @if ($item->respon != null)
                  <td class="text-uppercase text-danger">{{ $item->respon }}</td>
                  <td class="text-uppercase text-danger">{{ $item->catatan }}</td>
                @else
                  <td class="fs-5"><b>---</b></td>
                  <td class="fs-5"><b>---</b></td>
                @endif
                @if ($item->revisi != null)
                    <td class="text-uppercase text-info">{{ $item->revisi }}</td>  
                @elseif($item->catatan != null)
                    <td class="text-uppercase text-danger">menunggu</td> 
                @else
                    <td class="fs-5"><b>---</b></td>      
                @endif
                <td>
                    <a href="/setuju_kebutuhan_anggaran/{{ $item->slug }}" onclick="return confirm('Apakah anda yakin ingin mengnyetujui {{ $item->slug }} ?')" class="btn btn-primary"><i class="bi bi-check-circle"></i></a>
                    <a href="/tolak-anggaran/{{ $item->slug }}" class="btn btn-danger"><i class="bi bi-x-circle"></i></a>
                </td>
              </tr>
            @endforeach
          @else 
          <tr><td colspan="12" class="text-center">Tidak ada Data</td></tr>    
          @endif
      </table>
</div>
@endsection