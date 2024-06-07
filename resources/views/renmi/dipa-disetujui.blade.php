@extends('layouts.mainlayout')

@section('title', 'Dipa')

@section('content')
<h1 class="text-center">DAFTAR ISIAN PELAKSANAAN ANGGARAN</h1>
<div class="mt-5">
  <div class="row mb-3">
    <div class="col-6">

      {{-- spn --}}
      @if (Auth::user()->role_id == 4)
        <a href="/pengajuan-dipa-spn" class="btn btn-success mb-5 position-relative"><b>DIPA DIAJUKAN</b>
          @if (count($notif) > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              +1
              <span class="visually-hidden">unread messages</span>
            </span>
          @endif
        </a>
      @endif

      {{-- @if (Auth::user()->role_id == 2)
        <a href="/dipa-diajukan" class="btn btn-secondary position-relative"><b>PENGAJUAN DIPA</b>
          @if (count($dipaNotif) > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              +1
              <span class="visually-hidden">unread messages</span>
            </span>    
          @endif
        </a> --}}
        {{-- <a href="/dipa-disetujui" class="btn btn-success ms-3 position-relative"><b>DIPA BERJALAN</b>
          @if (count($dipaNotifikasi) > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              +1
              <span class="visually-hidden">unread messages</span>
            </span>    
          @endif
        </a> --}}
        {{-- <a href="/anggaranStaf" class="btn btn-info ms-3"><b>ANGGARAN/STAF</b></a>
      @endif
    </div> --}}
    {{-- @if (Auth::user()->role_id == 2) --}}
    <div class="col-6 text-end">
        {{-- <a href="/dipa-add" class="btn btn-primary"><b><i class="bi bi-plus-circle"></i> DIPA</b></a>
        <a href="/anggaran" class="btn btn-info"><b>ANGGARAN DIPA</b></a>
        <a href="/kegiatan" class="btn btn-info"><b>KEGIATAN</b></a>
        <a href="/program-kegiatan" class="btn btn-info"><b>PROGRAM KEGIATAN</b></a> --}}
      </div>
    </div>
  @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif
  {{-- @endif --}}
  <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          @if (Auth::user()->role_id == 2)
            <th scope="col">SPN</th>
          @endif
          <th scope="col">DIPA</th>
          <th scope="col">PROGRAM KEGIATAN</th>
          <th scope="col">DIPA AWAL</th>
          <th scope="col">DIPA AKHIR</th>
          {{-- <th scope="col">PENAMBAHAN</th>
          <th scope="col">PENGURANGAN</th> --}}
          <th scope="col">KEGIATAN</th>
          <th scope="col">RESPON</th>
          <th scope="col">CREATED_AT</th>
          @if (Auth::user()->role_id == 2)
            <th scope="col">AKSI</th>
          @endif
        </tr>
      </thead>
      <tbody class="table-group-divider">
        @if (count($dipa) >0 )
          @foreach ($dipa as $item)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              @if (Auth::user()->role_id == 2)
                <td>{{ $item->spn }}</td>
              @endif
              <td>{{ $item->jenis_dipa }}</td>
              <td>
                @foreach ($item->categoriesProgram as $itm)
                {{ $itm->program_kegiatan }}
                @endforeach
              </td>
              <td>{{ number_format($item->anggaran, 0, '.', '.') }}</td>
              <td>{{ number_format($item->anggaran_baru, 0, '.', '.') }}</td>
              {{-- @if ($item->penambahan_dana !=null)
                  <td>{{ $item->penambahan_dana }}</td>
              @else <td><i class="bi bi-x-lg"></i></td>    
              @endif --}}
              {{-- @if ($item->pengurangan_dana !=null)
                  <td>{{ $item->pengurangan_dana }}</td>
              @else <td><i class="bi bi-x-lg"></i></td>    
              @endif --}}
              <td>
                @foreach ($item->catrgoriesKegiatan as $items)
                  - {{ $items->kegiatan }} <br>
                @endforeach
              </td>
              <td class="text-uppercase text-success"><b>{{ $item->respon }}</b></td>
              <td>{{ $item->tanggal }} {{ $item->bulan }} {{ $item->tahun }}</td>
              @if (Auth::user()->role_id == 2)
              @if ($item->id == $dipaBaru->id)
                <td>
                  <a href="/tambah-dana-dipa/{{ $item->slug }}" class="btn btn-primary mb-2"><i class="bi bi-plus-lg"></i></a>
                  <a href="/kurang-dana-dipa/{{ $item->slug }}" class="btn btn-primary mb-2"><i class="bi bi-dash-lg"></i></a>
                </td>
              @else    
                <td>
                    <a style="font-size: 30px; color: rgb(11, 176, 11);"><i class="bi bi-check-lg"></i></a>
                </td>
              @endif
              @endif
            </tr>
          @endforeach
        @else
        <tr><td colspan="12" class="text-center">Tidak ada Data</td></tr>   
        @endif
    </table>
</div>
@endsection