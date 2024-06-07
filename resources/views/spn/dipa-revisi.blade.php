@extends('layouts.mainlayout')

@section('title', 'Dipa revisi')

@section('content')
  <h1 class="text-center">DIPA REVISI</h1>
    <div class="col-8  offset-2 mt-5">
        <form action="/dipa-revisi/{{ $dipa->slug }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            {{-- <input type="hidden" name="spn" value="{{ Auth::user()->nama }}"> --}}
            <div class="mb-3 row">
                <label for="jenis_dipa" class="col-sm-2 col-form-label"><b>JENIS DIPA</b></label>
                <div class="col-sm-10">
                  <input type="text" name="jenis_dipa" class="form-control" id="jenis_dipa" value="{{ $dipa->jenis_dipa }}" disabled>
                </div>
            </div> 
            <div class="mb-3 row">
              <label for="kegiatan" class="col-sm-2 col-form-label"><b>PROGRAM KEGIATAN</b></label>
              <div class="col-sm-10">
                <ul>
                  @foreach ($dipa->categoriesProgram as $item)
                      <li>{{ $item->program_kegiatan }}</li>
                  @endforeach
                </ul>
            </div>
          </div>
            <div class="mb-3 row">
                <label for="anggaran" class="col-sm-2 col-form-label"><b>TOTAL ANGGARAN</b></label>
                <div class="col-sm-10">
                  <input type="text" name="anggaran" class="form-control" id="anggaran" value="{{ $dipa->anggaran }}" disabled>
                </div>
            </div>   
            <div class="mb-3 row">
                <label for="kegiatan" class="col-sm-2 col-form-label"><b>AGENDA KEGIATAN</b></label>
                <div class="col-sm-10">
                  <ul>
                    @foreach ($dipa->catrgoriesKegiatan as $item)
                        <li>{{ $item->kegiatan }}</li>
                    @endforeach
                  </ul>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="revisi" class="col-sm-2 col-form-label"><b>CATATAN REVISI</b></label>
              <div class="col-sm-10">
                <textarea name="catatan" class="form-control @error('catatan') is-invalid @enderror" id="revisi" rows="3" autofocus></textarea>
                  @error('catatan')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
            </div>
            <div class="mb-3 row mt-4">
                <button type="submit" class="btn btn-primary btn-block">SIMPAN</button>
            </div>
        </form>
    </div>
@endsection