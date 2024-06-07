@extends('layouts.mainlayout')

@section('title', 'Realisasi Anggaran')

@section('content')
<h1 class="text-center">REALISASI KEBUTUHAN ANGGARAN</h1>
<div class="mt-5">



  
  <div class="row mb-3">
    <div class="col-6">
        <form action="" method="get">
            <div class="col-8 d-flex">
                <select name="unit" class="form-select me-2 btn-outline-primary" aria-label="Default select example" id="unit">
                     <option selected disabled>STAF</option>
                    @foreach ($staf as $item)
                        <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
                <select name="bulan" class="form-select me-2 btn-outline-primary" aria-label="Default select example">
                    <option selected disabled>BULAN</option>
                    <option value="januari">Januari</option>
                    <option value="februari">Februari</option>
                    <option value="maret">Maret</option>
                    <option value="april">April</option>
                    <option value="mei">Mei</option>
                    <option value="juni">Juni</option>
                    <option value="juli">Juli</option>
                    <option value="agustus">Agustus</option>
                    <option value="september">September</option>
                    <option value="oktober">Oktober</option>
                    <option value="november">November</option>
                    <option value="desember">Desember</option>
                </select>
                <select name="tahun" class="form-select btn-outline-primary" aria-label="Default select example">
                    <option selected disabled>TAHUN</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2023">2024</option>
                    <option value="2023">2025</option>
                    <option value="2023">2026</option>
                </select>
                <button type="submit" class="btn btn-primary ms-2">Cari</button>
            </div>    
        </form>
    </div>
    <div class="col-6 text-end">
    </div>
</div>



  @if (session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
  @endif
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">STAF</th>
            <th scope="col">JENIS DIPA</th>
            <th scope="col">PROGRAM KEGIATAN</th>
            <th scope="col">KEGIATAN</th>
            <th scope="col">SUB KEGIATAN</th>
            <th scope="col">VOLUME</th>
            <th scope="col">HARGA SATUAN</th>
            <th scope="col">PAGU</th>
            <th scope="col">RESPON</th>
            <th scope="col">AKSI</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          @if (count($realisasi) > 0)
            @foreach ($realisasi as $item)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $item->staf }}</td>
                <td>{{ $item->jenis_dipa }}</td>
                <td>{{ $item->program_kegiatan }}</td>
                <td>{{ $item->dipa_kegiatan }}</td>
                <td>{{ $item->kode_kegiatan }}-{{ $item->uraian_kegiatan }}</td>
                <td>{{ $item->volume }} {{ $item->list }}</td>
                <td>{{ number_format($item->harga_satuan, 0, '.', '.') }}</td>
                <td>{{ number_format($item->pagu, 0, '.', '.') }}</td>
                @if ($item->realisasi == 0)
                  <td>
                      <a href="/realisasi-anggaran/{{ $item->slug }}" class="btn btn-primary">REALISASIKAN</a>
                  </td>  
                @else 
                <td>
                    <a class="btn-primary" style="font-size: 30px"><i class="bi bi-check-lg"></i></a>
                </td>
                @endif


                @if($item->realisasi != 0)
                  <td>
                      <a href="/hapus-realisasi/{{ $item->slug }}" onclick="return confirm('Apakah anda yakin ingin menghapus data {{ $item->kegiatan }} ?')" class="btn btn-danger"><i class="bi bi-trash3-fill"></i>
                      </a>
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