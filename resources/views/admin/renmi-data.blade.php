@extends('layouts.mainlayout')

@section('title', 'Data Renmi')
@section('judul', 'Admin')

@section('content')
<div class="mt-5">
    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
        <a href="/renmi-add" class="btn btn-primary"><b>TAMBAH DATA</b></a>
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
          <th scope="col">NAMA</th>
          <th scope="col">PANGKAT</th>
          <th scope="col">NRP</th>
          <th scope="col">NO.TELPON</th>
          <th scope="col">EMAIL</th>
          <th scope="col">Posisi</th>
          <th scope="col">AKSI</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        @foreach ($renmi as $item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->nama }}</td>
              <td>{{ $item->pangkat }}</td>
              <td>{{ $item->nrp }}</td>
              <td>{{ $item->telpon }}</td>
              <td>{{ $item->email }}</td>
              <td>{{ $item->role->name }}</td>
              <td>
                <a href="/renmi-edit/{{ $item->slug }}" class="btn btn-warning">UBAH</a>
                <a href="/renmi-delete/{{ $item->slug }}" onclick="return confirm('Apakah anda yakin ingin menghapus data {{ $item->nama }} ?')" class="btn btn-danger">HAPUS</a>
              </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection