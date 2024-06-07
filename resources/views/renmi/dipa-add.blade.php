@extends('layouts.mainlayout')

@section('title', 'Tambah Dipa')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <h1>TAMBAH DIPA</h1>
    <div>
        <form action="/dipa-add" method="post" enctype="multipart/form-data">
            @csrf
            {{-- <input type="hidden" > --}}
            <div class="mt-5 w-50">
                <label for="jenis_dipa" class="form-label"><b>JENIS DIPA</b></label>
                <input type="text" name="jenis_dipa" id="jenis_dipa" class="form-control @error('jenis_dipa') is-invalid @enderror" placeholder="jenis_dipa"value="{{ old('jenis_dipa') }}">
                @error('jenis_dipa')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>  
            <div class="mt-3 w-50">
                <label for="programkegiatan" class="form-label"><b>PROGRAM KEGIATAN</b></label>
                <select name="programKegiatan[]" class="form-select select-multiple @error('programKegiatan') is-invalid @enderror" aria-label="Default select example" multiple>
                    @foreach ($program as $item)
                        <option value="{{ $item->id }}">{{ $item->program_kegiatan }}</option>
                    @endforeach
                </select>
                @error('programKegiatan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>  
            <div class="mt-3 w-50">
                <label for="anggaran" class="form-label"><b>ANGGARAN</b></label>
                <input type="number" name="anggaran" id="anggaran" class="form-control @error('anggaran') is-invalid @enderror" placeholder="anggaran"value="{{ old('anggaran') }}">
                @error('anggaran')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div class="form-text">(*Tanpa karakter - contoh: 1000000)</div>
            </div>
            <div class="mt-3 w-50">
                <label for="kegiatan" class="form-label"><b>URAIAN KEGIATAN</b></label>
                <select name="kegiatan[]" class="form-select select-multiple @error('kegiatan') is-invalid @enderror" aria-label="Default select example" multiple>
                    @foreach ($kegiatan as $item)
                        <option value="{{ $item->id }}">{{ $item->kegiatan }}</option>
                    @endforeach
                </select>
                @error('kegiatan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="row">
                <div class="mt-3" style="width: 150px">
                    <label for="tanggal" class="form-label"><b>TANGGAL</b></label>
                    <input type="number" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror"value="{{ old('tanggal') }}">
                    @error('tanggal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-3" style="width: 150px">
                    <label for="bulan" class="form-label"><b>BULAN</b></label>
                    <input type="text" name="bulan" id="bulan" class="form-control @error('bulan') is-invalid @enderror"value="{{ old('bulan') }}">
                    @error('bulan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-3" style="width: 150px">
                    <label for="tahun" class="form-label"><b>TAHUN</b></label>
                    <input type="number" name="tahun" id="tahun" class="form-control @error('tahun') is-invalid @enderror"value="{{ old('tahun') }}">
                    @error('tahun')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mt-3 w-50">
                <button type="submit" class="btn btn-primary">SIMPAN</button>
                <button type="reset" class="btn btn-danger">RESET</button>
            </div>
        </form>
    </div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select-multiple').select2();
    });
</script>
@endsection