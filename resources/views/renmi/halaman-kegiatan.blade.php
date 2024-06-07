@extends('layouts.mainlayout')

@section('title', 'Kegiatan')

@section('content')
<h1 class="text-center">DAFTAR KODE KEGIATAN</h1>
<div class="mt-5">
    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
        <a href="/kegiatan-add" class="btn btn-primary"><b><i class="bi bi-plus-circle"></i> KEGIATAN</b></a>
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
            <th scope="col">KODE</th>
            <th scope="col">URAIAN KEGIATAN</th>
            <th scope="col">AKSI</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          @foreach ($kegiatan as $item)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $item->kode }}</td>
              <td>{{ $item->kegiatan }}</td>
              <td>
                  <a href="/edit-kegiatan/{{ $item->slug }}" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>
                  <a href="/hapus-kegiatan/{{ $item->slug }}" onclick="return confirm('Apakah anda yakin ingin menghapus data {{ $item->kegiatan }} ?')" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a>
              </td>
            </tr>
          @endforeach
      </table>
</div>
@endsection