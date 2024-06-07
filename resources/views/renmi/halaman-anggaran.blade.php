@extends('layouts.mainlayout')

@section('title', 'anggaran')

@section('content')
<h1 class="text-center">ANGGARAN</h1>
<div class="mt-5">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">JENIS DIPA</th>
            <th scope="col">ANGGARAN</th>
            <th scope="col">DIGUNAKAN</th>
            <th scope="col">SISA ANGGARAN</th>
            <th scope="col">CREATED_AT</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          @if (count($anggaran) > 0)
            @foreach ($anggaran as $item)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $item->jenis_dipa }}</td>
                <td>{{ number_format($item->anggaran, 0, '.', '.') }}</td>
                <td>{{ number_format($item->total_digunakan, 0, '.', '.') }}</td>
                <td>{{ number_format($item->sisa_anggaran, 0, '.', '.') }}</td>
                <td>{{ $item->tanggal }}-{{ $item->bulan }}-{{ $item->tahun }}</td>
              </tr>
            @endforeach
          @else
          <tr><td colspan="12" class="text-center">Tidak ada Data</td></tr> 
          @endif
      </table>
</div>
@endsection