@extends('layouts.mainlayout')

@section('title', 'Edit Dipa')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <h1>EDIT DIPA</h1>
    <div>
        <form action="/dipa-update/{{ $dipa->slug }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            @if ($dipa->respon == 'no')
                <div class="mt-5 w-50">
                    <label class="form-label"><b>CATATAN REVISI</b></label>
                    <textarea class="form-control text-uppercase text-danger" cols="30" disabled>{{ $dipa->catatan }}</textarea>
                </div>
            @endif
            <div class="mt-5 w-50">
                <label for="jenis_dipa" class="form-label"><b>JENIS DIPA</b></label>
                <input type="text" name="jenis_dipa" id="jenis_dipa" class="form-control @error('jenis_dipa') is-invalid @enderror" placeholder="jenis_dipa"value="{{ old('jenis_dipa', $dipa->jenis_dipa) }}">
                @error('jenis_dipa')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>  
            <div class="mt-3 w-50">
                <label for="currentCategory" class="form-label"><b>PROGRAM KEGIATAN SEBELUMNYA</b></label>
                <ul>
                    @foreach ($dipa->categoriesProgram as $items)
                        <li>{{ $items->program_kegiatan }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-3 w-50">
                <label for="program_kegiatan" class="form-label"><b>PROGRAM KEGIATAN</b></label>
                <select name="program_kegiatan[]" class="form-select select-multiple @error('program_kegiatan') is-invalid @enderror" aria-label="Default select example" multiple>
                    @foreach ($program as $item)
                        <option value="{{ $item->id }}">{{ $item->program_kegiatan }}</option>
                    @endforeach
                </select>
                @error('program_kegiatan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>  
            <div class="mt-3 w-50">
                <label for="anggaran" class="form-label"><b>ANGGARAN</b></label>
                <input type="number" name="anggaran" id="anggaran" class="form-control @error('anggaran') is-invalid @enderror" placeholder="anggaran"value="{{ old('anggaran', $dipa->anggaran) }}">
                @error('anggaran')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div class="form-text">(*Tanpa karakter - contoh: 1000000)</div>
            </div>
            <div class="mt-3 w-50">
                <label for="currentCategory" class="form-label"><b>URAIAN KEGIATAN SEBELUMNYA</b></label>
                <ul>
                    @foreach ($dipa->catrgoriesKegiatan as $items)
                        <li>{{ $items->kegiatan }}</li>
                    @endforeach
                </ul>
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
            <div class="mt-3 w-50">
                @if ($dipa->respon == 'ditolak')
                    <button type="submit" class="btn btn-success">AJUKAN</button>
                @else
                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                    <button type="reset" class="btn btn-danger">RESET</button>
                @endif
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