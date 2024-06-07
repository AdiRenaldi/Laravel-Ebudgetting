@extends('layouts.mainlayout')

@section('title', 'Edit Kegiatan')

@section('content')
    <h1>EDIT KEGIATAN</h1>
    <div>
        <form action="/update-kegiatan/{{ $kegiatan->slug }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mt-5 w-50">
                <label for="kode" class="form-label"><b>KODE KEGIATAN</b></label>
                <input type="text" name="kode" id="kode" class="form-control @error('kode') is-invalid @enderror" placeholder="kode" value="{{ old('kode',$kegiatan->kode) }}">
                @error('kode')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>    
            <div class="mt-3 w-50">
                <label for="kegiatan" class="form-label"><b>URAIAN KEGIATAN</b></label>
                <input type="kegiatan" name="kegiatan" id="kegiatan" class="form-control @error('kegiatan') is-invalid @enderror" placeholder="kegiatan" value="{{ old('kegiatan', $kegiatan->kegiatan) }}">
                @error('kegiatan')
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