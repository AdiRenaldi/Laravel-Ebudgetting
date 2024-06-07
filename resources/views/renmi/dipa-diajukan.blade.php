@extends('layouts.mainlayout')

@section('title', 'Pengajuan Dipa')

@section('content')
<h1 class="text-center">PENGAJUAN DIPA</h1>
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
            <th scope="col">ANGGARAN</th>
            <th scope="col">KEGIATAN</th>
            <th scope="col">RESPON</th>
            <th scope="col">REVISI</th>
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
                  @foreach ($item->categoriesProgram as $program)
                  - {{ $program->program_kegiatan }} <br>
                  @endforeach
                </td>
                <td>{{ number_format($item->anggaran, 0, '.', '.') }}</td>
                <td>
                  @foreach ($item->catrgoriesKegiatan as $items)
                  - {{ $items->kegiatan }} <br>
                  @endforeach
                </td>
                @if ($item->respon != null)
                  <td class="text-uppercase text-danger">ditolak</td>
                @else
                  <td class="fs-5"><b>---</b></td>
                @endif
                @if ($item->revisi != 0 && $item->respon !=0)
                    <td class="text-uppercase text-secondary">menunggu persetujuan</td>
                @else
                <td class="fs-5"><b>---</b></td>   
                @endif
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