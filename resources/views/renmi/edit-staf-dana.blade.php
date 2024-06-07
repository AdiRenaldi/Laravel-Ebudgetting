@extends('layouts.mainlayout')

@section('title', 'Edit Staf Dana')

@section('content')
    <h1>EDIT STAF DANA</h1>
    <div>
        <form action="/update-staf-dana/{{ $staf->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mt-5 w-50">
                <label for="staf" class="form-label"><b>STAF</b></label>
                <input type="text" id="staf" class="form-control" value="{{ $staf->staf->nama }}" disabled>
            </div>
            <div class="mt-5 w-50">
                <label for="total_anggaran" class="form-label"><b>TOTAL ANGGARAN</b></label>
                <input type="text" name="total_anggaran" id="total_anggaran" class="form-control @error('total_anggaran') is-invalid @enderror" placeholder="total_anggaran" value="{{ old('total_anggaran',$staf->total_anggaran) }}" autofocus>
                @error('total_anggaran')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div class="form-text">(*Tanpa karakter - contoh: 1000000)</div>
            </div>
            <div class="mt-3 w-50">
                <button type="submit" class="btn btn-primary">SIMPAN</button>
                <button type="reset" class="btn btn-danger">RESET</button>
            </div>
        </form>
    </div>
@endsection