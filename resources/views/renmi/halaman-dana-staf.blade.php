@extends('layouts.mainlayout')

@section('title', 'Dana staf')

@section('content')
<h1 class="text-center">DIPA STAF</h1>
<div class="mt-5">
  <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
      <a href="/penyaluran-dana" class="btn btn-primary"><b><i class="bi bi-share"></i> DANA</b></a>
  </div>
    @if (session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
    @elseif (session('error'))
      <div class="alert alert-danger">
          {{ session('error') }}
      </div>
    @elseif (session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
    @endif
  <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">JENIS DIPA</th>
          <th scope="col">STAF</th>
          <th scope="col">ANGGARAN</th>
          <th scope="col">PENAMBAHAN</th>
          <th scope="col">PENGURANGAN</th>
          <th scope="col">TOTAL PEMAKAIAN</th>
          <th scope="col">SISA ANGGARAN</th>
          <th scope="col">CREATED_AT</th>
          <th scope="col">AKSI</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        @if (!empty($danaStaf))
          @foreach ($danaStaf as $item)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $item->jenis_dipa }}</td>
              <td>{{ $item->staf->nama }}</td>
              <td>{{ number_format($item->total_anggaran, 0, '.', '.') }}</td>
              @if ($item->penambahan_dana !=null)
                  <td>{{ number_format($item->penambahan_dana, 0, '.', '.') }}</td>
              @else <td><i class="bi bi-x-lg"></i></td>    
              @endif
              @if ($item->pengurangan_dana !=null)
                  <td>{{ number_format($item->pengurangan_dana, 0, '.', '.') }}</td>
              @else <td><i class="bi bi-x-lg"></i></td>    
              @endif
              <td>{{ number_format($item->total_pemakaian, 0, '.', '.') }}</td>
              <td>{{ number_format($item->sisa_anggaran, 0, '.', '.') }}</td>
              <td>{{ $item->tanggal }} {{ $item->bulan }} {{ $item->tahun }}</td>
              @if ($dipa->id == $item->dipa_id)
                <td>
                  <a href="/edit-dana-staf/{{ $item->id }}" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>
                  <a href="/tambah-dana-staf/{{ $item->id }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i></a>
                  <a href="/kurang-dana-staf/{{ $item->id }}" class="btn btn-primary"><i class="bi bi-dash-lg"></i></a>
                </td>
              @else
                <td>
                    <a style="font-size: 30px; color: rgb(11, 176, 11);"><i class="bi bi-check-lg"></i></a>
                </td>
              @endif
            </tr>
          @endforeach
        @else
        <tr><td colspan="12" class="text-center">Tidak ada Data</td></tr>      
        @endif
    </table>
</div>
@endsection