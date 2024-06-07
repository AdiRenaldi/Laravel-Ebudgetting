@extends('layouts.mainlayout')

@section('title', 'Tambah Renmi')

@section('content')
    <h1>TAMBAH DATA RENMI</h1>
    <div>
        <form action="/renmi-add" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mt-5 w-50">
                <label for="username" class="form-label"><b>USERNAME</b></label>
                <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="username" value="{{ old('username') }}">
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>    
            <div class="mt-3 w-50">
                <label for="password" class="form-label"><b>PASSWORD</b></label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="password">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mt-3 w-50">
                <label for="nama" class="form-label"><b>NAMA</b></label>
                <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="nama" value="{{ old('nama') }}">
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>  
            <div class="mt-3 w-50">
                <label for="pangkat" class="form-label"><b>PANGKAT</b></label>
                <input type="text" name="pangkat" id="pangkat" class="form-control @error('pangkat') is-invalid @enderror" placeholder="pangkat" value="{{ old('pangkat') }}">
                @error('pangkat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mt-3 w-50">
                <label for="nrp" class="form-label"><b>NRP</b></label>
                <input type="text" name="nrp" id="nrp" class="form-control @error('nrp') is-invalid @enderror" placeholder="nrp" value="{{ old('nrp') }}">
                @error('nrp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>  
            <div class="mt-3 w-50">
                <label for="telpon" class="form-label"><b>NO.TELPON</b></label>
                <input type="number" name="telpon" id="telpon" class="form-control @error('telpon') is-invalid @enderror" placeholder="telpon" value="{{ old('telpon') }}">
                @error('telpon')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>   
            <div class="mt-3 w-50">
                <label for="email" class="form-label"><b>EMAIL</b></label>
                <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="email" value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>   
            <div class="mt-3">
                <button type="submit" class="btn btn-success">SIMPAN</button>
            </div>
        </form>
    </div>
@endsection