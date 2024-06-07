@extends('layouts.mainlayout')

@section('title', 'Edit Revisi')

@section('content')
  <h1 class="text-center">EDIT REVISI</h1>
    <div class="col-8  offset-2 mt-5">
        <form action="/staf-revisi/{{ $data->slug }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="hidden" name="spn" value="{{ Auth::user()->nama }}">
            <div class="mb-3 row">
                <label for="jenis_dipa" class="col-sm-3 col-form-label"><b>JENIS DIPA</b></label>
                <div class="col-sm-9">
                  <input type="text" name="jenis_dipa" class="form-control" id="jenis_dipa" value="{{ $data->jenis_dipa }}" disabled>
                </div>
            </div> 
            <div class="mb-3 row">
                <label for="program_kode" class="col-sm-3 col-form-label"><b>PROGRAM KEGIATAN</b></label>
                <div class="col-sm-9">
                  <input type="text" name="program_kode" class="form-control" id="program_kode" value="{{ $data->program_kode }}" disabled>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="dipa_kode" class="col-sm-3 col-form-label"><b>KEGIATAN</b></label>
                <div class="col-sm-9">
                  <input type="text" name="dipa_kode" class="form-control" id="dipa_kode" value="{{ $data->dipa_kode }}" disabled>
                </div>
            </div>  
            <div class="mb-3 row">
                <label for="uraian" class="col-sm-3 col-form-label"><b>URAIAN KEGIARAN</b></label>
                <div class="col-sm-9">
                  <input type="text" name="uraiaan" class="form-control" id="uraian" value="{{ $data->kode }}-{{ $data->uraiaan }}" disabled>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="bidang" class="col-sm-3 col-form-label"><b>BIDANG</b></label>
                <div class="col-sm-9">
                  <input type="text" name="uraiaan" class="form-control" id="bidang" value="{{ $data->staf->bidang }}" disabled>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="volume" class="col-sm-3 col-form-label"><b>VOLUME</b></label>
                <div class="col-sm-9">
                  <input type="text" name="volume" class="form-control" id="volume" value="{{ $data->volume }}" disabled>
                </div>
            </div>
            <div class="mb-3 row">
              <label for="harga_satuan" class="col-sm-3 col-form-label"><b>HARGA SATUAN</b></label>
              <div class="col-sm-9">
                <input type="number" name="harga_satuan" class="form-control" id="harga_satuan" value="{{ $data->harga_satuan }}" disabled>
                  @error('harga_satuan')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
            </div>
            <div class="mb-3 row">
              <label for="revisi" class="col-sm-3 col-form-label"><b>REVISI</b></label>
              <div class="col-sm-9">
                <textarea name="catatan" class="form-control @error('kode') is-invalid @enderror" id="revisi" rows="3" autofocus></textarea>
                  @error('revisi')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">SIMPAN</button>
                <a href="/meyetujui-anggaran" class="btn btn-danger">BATAL</a>
            </div>
        </form>
    </div>
@endsection