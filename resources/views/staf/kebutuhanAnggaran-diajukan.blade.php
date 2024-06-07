@extends('layouts.mainlayout')

@section('title', 'Dipa Diajukan')

@section('content')
<h1 class="text-center">DAFTAR LIST KEBUTUHAN YANG DIAJUKAN</h1>
<div class="mt-5">
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
            <th scope="col">PROGRAM KEGIATAN</th>
            <th scope="col">KEGIATAN</th>
            <th scope="col">VOLUME</th>
            <th scope="col">SUB KEGIATAN</th>
            <th scope="col">HARGA SATUAN</th>
            <th scope="col">PAGU</th>
            <th scope="col">RESPON</th>
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
                <td>{{ $item->volume }}</td>
                <td>{{ $item->kode }}-{{ $item->uraiaan }}</td>
                <td>{{ number_format($item->harga_satuan, 0, '.', '.') }}</td>
                <td>{{ number_format($item->pagu, 0, '.', '.') }}</td>
                @if ($item->respon != null)
                  <td class="text-uppercase text-danger">{{ $item->respon }}</td>
                @else
                  <td class="fs-5"><b>---</b></td>
                @endif
                @if ($item->revisi != 0 && $item->respon !=0)
                    <td class="text-uppercase text-secondary">menunggu persetujuan</td>
                @else
                <td class="fs-5"><b>---</b></td>   
                @endif
                <td>
                  {{-- @if ($item->respon == null)
                      <a class="btn btn-secondary"><i class="bi bi-pencil-fill"></i></a>
                      <a class="btn btn-secondary"><i class="bi bi-trash3-fill"></i></a>
                  @else --}}
                     <a href="/ajukan_kebutuhan_anggaran/{{ $item->slug }}" onclick="return confirm('Apakah anda yakin ingin mengajukan data {{ $item->slug }} ?')" class="btn btn-info"><i class="bi bi-send-check"></i></a>
                      <a href="/edit-kebutuhan-anggaran/{{ $item->slug }}" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>
                      <a href="/delete-kebutuhan-anggaran/{{ $item->slug }}" onclick="return confirm('Apakah anda yakin ingin menghapus data {{ $item->slug }} ?')" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a>
                  {{-- @endif --}}
                </td>
              </tr>
            @endforeach
          @else
          <tr><td colspan="12" class="text-center">Tidak ada Data</td></tr>
          @endif
      </table>
</div>
@endsection