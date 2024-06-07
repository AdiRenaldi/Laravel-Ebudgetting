@extends('layouts.mainlayout')

@section('title', 'Spn Dipa')

@section('content')
<h1 class="text-center">PENGAJUAN DIPA</h1>
<div class="mt-5">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">JENIS DIPA</th>
            <th scope="col">PROGRAM KEGIATAN</th>
            <th scope="col">AGENDA KEGIATAN</th>
            <th scope="col">TOTAL ANGGARAN</th>
            <th scope="col">RESPON</th>
            <th scope="col">CATATAN</th>
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
                  @foreach ($item->categoriesProgram as $items)
                  - {{ $items->program_kegiatan }} <br>
                  @endforeach
                </td>
                <td>
                  @foreach ($item->catrgoriesKegiatan as $items)
                  - {{ $items->kegiatan }} <br>
                  @endforeach
                </td>
                <td>{{ number_format($item->anggaran, 0, '.', '.') }}</td>
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
                <td>{{ $item->tanggal }}-{{ $item->bulan }}-{{ $item->tahun }}</td>
                <td>
                    <a href="/setuju-dipa/{{ $item->slug }}" onclick="return confirm('Apakah anda yakin ingin menyetujui data {{ $item->slug }} ?')" class="btn btn-success"><i class="bi bi-check-circle"></i></a>
                    <a href="/tolak-dipa/{{ $item->slug }}" class="btn btn-danger"><i class="bi bi-x-circle"></i></a>
                </td>
              </tr>
            @endforeach
          @else
          <tr><td colspan="12" class="text-center">Tidak ada Data</td></tr> 
          @endif
    </table>
</div>
@endsection