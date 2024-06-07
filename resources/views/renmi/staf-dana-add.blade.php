@extends('layouts.mainlayout')

@section('title', 'Staf Dana')

@section('content')
    <h1>SALURKAN DANA</h1>
    <div>
        <form action="/staf-dana-add" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="dipa_id" value="{{ $dipa->id }}">
            <div class="mt-5 w-50">
                <label for="jenis_dipa" class="form-label"><b>JENIS DIPA</b></label>
                <input type="text" name="jenis_dipa" id="jenis_dipa" class="form-control"value="{{ $dipa->jenis_dipa }}" readonly>
            </div>  
            <div class="mt-3 w-50">
                <label for="staf" class="form-label"><b>STAF</b></label>
                <select name="staf" class="form-select select-multiple @error('staf') is-invalid @enderror" aria-label="Default select example">
                    <option selected disabled>Pilih Staf</option>
                    @foreach ($staf as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
                @error('staf')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>  
            <div class="mt-3 w-50">
                <label for="total_anggaran" class="form-label"><b>TOTAL ANGGARAN</b></label>
                <input type="number" name="total_anggaran" id="total_anggaran" class="form-control @error('total_anggaran') is-invalid @enderror"value="{{ old('total_anggaran') }}">
                @error('total_anggaran')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div class="form-text">(*Tanpa karakter - contoh: 1000000)</div>
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
@endsection