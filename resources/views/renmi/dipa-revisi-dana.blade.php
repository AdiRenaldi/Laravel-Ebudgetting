@extends('layouts.mainlayout')

@if (request()->route()->uri == 'tambah-dana-dipa/{slug}')
    @section('title', 'Tambah Dana')
@else    
    @section('title', 'Kurang dana')
@endif

@section('content')
@if (request()->route()->uri == 'tambah-dana-dipa/{slug}')
    <h1>TAMBAH DANA DIPA</h1>
@else   
    <h1>KURANG DANA DIPA</h1>
@endif
    <div>
        @if (request()->route()->uri == 'tambah-dana-dipa/{slug}')
            <form action="/tambah-dana-dipa/{{ $dipa->slug }}" method="post" enctype="multipart/form-data">
        @else   
            <form action="/kurang-dana-dipa/{{ $dipa->slug }}" method="post" enctype="multipart/form-data">
        @endif
            @csrf
            @method('put')
            <div class="mt-5 w-50">
                <label for="dana_awal" class="form-label"><b>JUMLAH DANA</b></label>
                <input type="text" id="dana_awal" class="form-control" value="{{ number_format($dipa->anggaran_baru, 0, '.', '.') }}" disabled>
            </div>
            <div class="mt-3 w-50">
                @if (request()->route()->uri == 'tambah-dana-dipa/{slug}')
                    <label for="revisi" class="form-label"><b>TAMBAHAN DANA</b></label>
                @else 
                    <label for="revisi" class="form-label"><b>KURANGKAN DANA </b></label> 
                @endif
                <input type="number" name="revisi" id="revisi" class="form-control @error('revisi') is-invalid @enderror" placeholder="masukkan jumlah dana" placeholder="Masukan dana" value="{{ old('revisi') }}">
                @error('revisi')
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