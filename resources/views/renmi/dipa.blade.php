@extends('layouts.mainlayout')

@section('title', 'Data Dipa')

@section('content')
<h1 class="text-center">Kelola Data DIPA</h1>
<div class="mt-5">
    <div class="row mb-3">
      <div class="col-6">
        <a href="/dipa-diajukan" class="btn btn-secondary position-relative"><b>PENGAJUAN DIPA</b>
          @if (count($dipaNotif) > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              +1
              <span class="visually-hidden">unread messages</span>
            </span>    
          @endif
        </a>
        <a href="/dipa-disetujui" class="btn btn-success ms-3 position-relative"><b>DIPA BERJALAN</b>
          @if (count($dipaNotifikasi) > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              +1
              <span class="visually-hidden">unread messages</span>
            </span>    
          @endif
        </a>
        <a href="/anggaranStaf" class="btn btn-info ms-3"><b>ANGGARAN/STAF</b></a>
      </div>
      <div class="col-6 text-end">
        <a href="/dipa-add" class="btn btn-primary"><b><i class="bi bi-plus-circle"></i> DIPA</b></a>
        <a href="/anggaran" class="btn btn-info"><b>ANGGARAN DIPA</b></a>
        <a href="/kegiatan" class="btn btn-info"><b>KEGIATAN</b></a>
        <a href="/program-kegiatan" class="btn btn-info"><b>PROGRAM KEGIATAN</b></a>
      </div>
    </div>
    @if (session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
    @endif
    @if (session('warning'))
      <div class="alert alert-danger">
          {{ session('warning') }}
      </div>
    @endif
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">JENIS DIPA</th>
            <th scope="col">PROGRAM KEGIATAN</th>
            <th scope="col">ANGGARAN</th>
            <th scope="col">KEGIATAN</th>
            <th scope="col">CREATED_AT</th>
            <th scope="col">AKSI</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          @if (count($dipa) > 0)
            @foreach ($dipa as $item)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $item->jenis_dipa }}</td>
                <td>
                  @foreach ($item->categoriesProgram as $items)
                  - {{ $items->program_kegiatan }} <br>
                  @endforeach
                </td>
                <td>{{ number_format($item->anggaran, 0, '.', '.') }}</td>
                <td>
                  @foreach ($item->catrgoriesKegiatan as $items)
                  - {{ $items->kegiatan }} <br>
                  @endforeach
                </td>
                <td>{{ $item->tanggal }} {{ $item->bulan }} {{ $item->tahun }}</td>
                <td>
                    <a href="/dipa-ajukan/{{ $item->slug }}" onclick="return confirm('Apakah anda yakin ingin mengajukan data {{ $item->jenis_dipa }} ?')" class="btn btn-primary"><i class="bi bi-send-check"></i></a>
                    <a href="/dipa-edit/{{ $item->slug }}" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>
                    <a href="/dipa-delete/{{ $item->slug }}" onclick="return confirm('Apakah anda yakin ingin menghapus data {{ $item->jenis_dipa }} ?')" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a>
                </td>
              </tr>
            @endforeach
          @else
            <tr><td colspan="12" class="text-center">Tidak ada Data</td></tr>  
          @endif
      </table>
</div>
@endsection