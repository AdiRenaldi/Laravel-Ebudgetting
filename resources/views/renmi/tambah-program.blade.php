@extends('layouts.mainlayout')

@section('title', 'Tambah Program Kegiatan')

@section('content')
    <h1>TAMBAH PROGRAM KEGIATAN</h1>
    <div>
        <form action="/program-add" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mt-5 w-50">
                <label for="kode" class="form-label"><b>KODE PROGRAM</b></label>
                <input type="text" name="kode" id="kode" class="form-control @error('kode') is-invalid @enderror" placeholder="kode" value="{{ old('kode') }}">
                @error('kode')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>    
            <div class="mt-3 w-50">
                <label for="program_kegiatan" class="form-label"><b>PROGRAM KEGIATAN</b></label>
                <input type="program_kegiatan" name="program_kegiatan" id="program_kegiatan" class="form-control @error('program_kegiatan') is-invalid @enderror" placeholder="program_kegiatan" value="{{ old('program_kegiatan') }}">
                @error('program_kegiatan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mt-3 w-50">
                <button type="submit" class="btn btn-primary">SIMPAN</button>
                <button type="reset" class="btn btn-danger">RESET</button>
            </div>
        </form>
    </div>
@endsection