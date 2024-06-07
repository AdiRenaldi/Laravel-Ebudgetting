@extends('layouts.mainlayout')

@section('title', 'Data Kebutuhan Anggaran')

@section('content')
<h1 class="text-center">LIST KEBUTUHAN ANGGARAN</h1>
<div class="mt-5">
  <div class="row mb-3">
    <div class="col-6">
      <a href="/anggaran-diajukan" class="btn btn-secondary position-relative"><b>AJUKAN</b>
        @if (count($ajukan) > 0)
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            +1
            <span class="visually-hidden">unread messages</span>
          </span>  
        @endif
      </a>
      <a href="/anggaran-disetujui" class="btn btn-info ms-3 position-relative"><b>SETUJU</b>
        @if (count($setuju) > 0)
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            +1
            <span class="visually-hidden">unread messages</span>
          </span>  
        @endif
      </a>
      <a href="/anggaran-direalisasikan" class="btn btn-success ms-3 position-relative"><b>REALISASI</b>
        @if (count($realisasi) > 0)
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            +1
            <span class="visually-hidden">unread messages</span>
          </span>  
        @endif
      </a>
    </div>
    <div class="col-6 text-end">
      <a href="/Staf_add_kebutuhan_anggaran" class="btn btn-primary"><b>TAMBAH</b></a>
    </div>
   </div>
    @if (session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
    @endif
    <table class="table">
        <thead>
          <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">PROGRAM</th>
            <th scope="col">KEGIATAN</th>
            <th scope="col">KODE</th>
            <th scope="col">SUB KEGIATAN</th>
            <th scope="col">VOLUME</th>
            <th scope="col">HARGA SATUAN</th>
            <th scope="col">PAGU</th>
            <th scope="col">AKSI</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          @if (count($anggaran) > 0)
            @foreach ($anggaran as $item)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $item->program_kode }}</td>
                <td>{{ $item->dipa_kode }}</td>
                <td>{{ $item->kode }}</td>
                <td>{{ $item->uraiaan }}</td>
                <td class="text-center">{{ $item->volume }}</td>
                <td>{{ number_format($item->harga_satuan, 0, '.', '.') }} {{ $item->list }}</td>
                <td>{{ number_format($item->pagu, 0, '.', '.') }}</td>
                <td class="text-center">
                    <a href="/ajukan_kebutuhan_anggaran/{{ $item->slug }}" onclick="return confirm('Apakah anda yakin ingin mengajukan data {{ $item->slug }} ?')" class="btn btn-info"><i class="bi bi-send-check"></i></a>
                    <a href="/edit-kebutuhan-anggaran/{{ $item->slug }}" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>
                    <a href="/delete-kebutuhan-anggaran/{{ $item->slug }}" onclick="return confirm('Apakah anda yakin ingin menghapus data {{ $item->slug }} ?')" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a>
                </td>
              </tr>
            @endforeach  
          @else 
          <tr><td colspan="12" class="text-center">Tidak ada Data</td></tr>   
          @endif
      </table>
</div>
@endsection