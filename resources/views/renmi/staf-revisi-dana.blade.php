@extends('layouts.mainlayout')

@if (request()->route()->uri == 'tambah-dana-staf/{id}')
    @section('title', 'Tambah Dana Staf')
@else    
    @section('title', 'Kurang Dana Staf')
@endif

@section('content')
@if (request()->route()->uri == 'tambah-dana-staf/{id}')
    <h1>TAMBAH DANA STAF</h1>
@else   
    <h1>KURANG DANA STAF</h1>
@endif
    <div>
        @if (request()->route()->uri == 'tambah-dana-staf/{id}')
            <form action="/tambah-dana-staf/{{ $anggaran->id }}" method="post" enctype="multipart/form-data">
        @else   
            <form action="/kurang-dana-staf/{{ $anggaran->id }}" method="post" enctype="multipart/form-data">
        @endif
            @csrf
            @method('put')
            <div class="mt-5 w-50">
                <label for="dana_awal" class="form-label"><b>STAF</b></label>
                <input type="text" id="dana_awal" class="form-control" value="{{ $anggaran->staf->nama }}" disabled>
            </div>
            <div class="mt-3 w-50">
                @if (request()->route()->uri == 'tambah-dana-staf/{id}')
                    @if ($dipa->penambahan_dana !=null)
                        <label for="dana_awal" class="form-label"><b>PENAMBAHAN ANGGARAN DIPA</b></label>
                        <input type="text" id="dana_awal" class="form-control" value="{{ number_format($dipa->penambahan_dana, 0, '.', '.') }}" disabled> 
                    @endif
                @endif
                @if (request()->route()->uri == 'kurang-dana-staf/{id}')
                    @if ($dipa->pengurangan_dana !=null)
                        <label for="dana_awal" class="form-label"><b>PENGURANGAN ANGGARAN DIPA</b></label>
                        <input type="text" id="dana_awal" class="form-control" value="{{ number_format($dipa->pengurangan_dana, 0, '.', '.') }}" disabled>     
                    @endif
                @endif
            </div>
            <div class="mt-3 w-50">
                <label for="dana_awal" class="form-label"><b>JUMLAH_DANA</b></label>
                <input type="text" id="dana_awal" class="form-control" value="{{ number_format($anggaran->sisa_anggaran, 0, '.', '.') }}" disabled>
            </div>
            <div class="mt-3 w-50">
                @if (request()->route()->uri == 'tambah-dana-staf/{id}')
                    <label for="staf_revisi" class="form-label"><b>TAMBAHAN DANA</b></label>
                @else 
                    <label for="staf_revisi" class="form-label"><b>KURANGKAN DANA </b></label> 
                @endif
                <input type="number" name="staf_revisi" id="staf_revisi" class="form-control @error('staf_revisi') is-invalid @enderror" placeholder="masukkan jumlah dana" placeholder="Masukan dana" value="{{ old('staf_revisi') }}">
                @error('staf_revisi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div class="form-text">(*Tanpa karakter - contoh: 1000000)</div>
            </div>
            <div class="row mt-3">
                <label for="tanggal" class="form-label"><b>TANGGAL</b></label>
                <div class="" style="width: 150px">
                    <input type="number" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror"value="{{ old('tanggal') }}" placeholder="tanggal">
                    @error('tanggal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="" style="width: 150px">
                    <input type="text" name="bulan" id="bulan" class="form-control @error('bulan') is-invalid @enderror"value="{{ old('bulan') }}" placeholder="bulan">
                    @error('bulan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="" style="width: 150px">
                    <input type="number" name="tahun" id="tahun" class="form-control @error('tahun') is-invalid @enderror"value="{{ old('tahun') }}" placeholder="tahun">
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
@endsection