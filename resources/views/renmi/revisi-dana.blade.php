@extends('layouts.mainlayout')

@section('title', 'Revisi Dana')

@section('content')
<h1 class="text-center">LAPORAN REVISI ANGGARAN</h1>
<div class="row mb-5">
  <form action="" method="get">
      <div class="d-flex">
          <select name="revisi" class="form-select me-2 w-25" aria-label="Default select example" id="unit">
              <option selected disabled>MASUKKAN TAHUN DIPA</option>
              @foreach ($dipa as $item)
                  <option value="{{ $item->id }}">{{ $item->jenis_dipa }}</option>
              @endforeach
          </select>
          <button type="submit" class="btn btn-primary ms-2">Cari</button>
      </div>
  </form>
</div>

<div class="row">
  <div class="col-6">
    <h3 class="text-center mb-5"><b>REVISI DIPA</b></h3>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">NO</th>
          <th scope="col">DIPA</th>
          <th scope="col">DIPA AWAL</th>
          <th scope="col">PENAMBAHAN</th>
          <th scope="col">PENGURANGAN</th>
          <th scope="col">DIPA AKHIR</th>
          <th scope="col">TANGGAL</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        @if (count($revisi) > 0)
          @foreach ($revisi as $item)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $item->dipa->jenis_dipa }}</td>
              <td>{{ number_format($item->dana_awal, 0, '.', '.') }}</td>
              <td>{{ number_format($item->penambahan_dana, 0, '.', '.') }}</td>
              <td>{{ number_format($item->pengurangan_dana, 0, '.', '.') }}</td>
              <td>{{ number_format($item->dana_sekarang, 0, '.', '.') }}</td>
              <td>{{ $item->tanggal }} {{ $item->bulan }} {{ $item->tahun }}</td>
            </tr>
          @endforeach
          <tr>
              <th colspan="3">TOTAL
                  <th>{{ number_format($tambahDipa, 0, '.', '.') }}</th> 
                  <th colspan="4">{{ number_format($kurangDipa, 0, '.', '.') }}</th>
              </th>
          </tr>
        @else
        <tr><td colspan="12" class="text-center">Tidak ada Data</td></tr> 
        @endif
    </table>
  </div>
  <div class="col-6">
    <h3 class="text-center mb-5"><b>REVISI STAF</b></h3>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">NO</th>
          <th scope="col">DIPA</th>
          <th scope="col">STAF</th>
          <th scope="col">DIPA AWAL</th>
          <th scope="col">PENAMBAHAN</th>
          <th scope="col">PENGURANGAN</th>
          <th scope="col">DIPA AKHIR</th>
          <th scope="col">TANGGAL</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        @if (count($revisiStaf) > 0)
          @foreach ($revisiStaf as $item)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $item->dipa->jenis_dipa }}</td>
              <td>{{ $item->staf->nama }}</td>
              <td>{{ $item->dana_awal }}</td>
              <td>{{ number_format($item->penambahan_dana, 0, '.', '.') }}</td>
              <td>{{ number_format($item->pengurangan_dana, 0, '.', '.') }}</td>
              <td>{{ number_format($item->dana_sekarang, 0, '.', '.') }}</td>
              <td>{{ $item->tanggal }} {{ $item->bulan }} {{ $item->tahun }}</td>
            </tr>
          @endforeach
          <tr>
              <th colspan="4">TOTAL
                  <th>{{ number_format($tambahStaf, 0, '.', '.') }}</th> 
                  <th colspan="4">{{ number_format($kurangStaf, 0, '.', '.') }}</th>
              </th>
          </tr>
        @else
        <tr><td colspan="12" class="text-center">Tidak ada Data</td></tr> 
        @endif
    </table>
  </div>
</div>
@endsection