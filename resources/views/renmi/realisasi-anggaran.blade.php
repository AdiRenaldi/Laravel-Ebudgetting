@extends('layouts.mainlayout')

@section('title', 'Realisasi Anggaran')

@section('content')
  <h1 class="text-center">REALISASI ANGGARAN</h1>
    <div class="col-8  offset-2 mt-5">
        <form action="/update-realisasiAnggaran/{{ $laporanAnggaran->slug }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-3 row">
                <label for="bidang" class="col-sm-3 col-form-label"><b>BIDANG</b></label>
                <div class="col-sm-9">
                  <input type="text" name="bidang" class="form-control" id="bidang" value="{{ $laporanAnggaran->bidang }}" disabled>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jenis_dipa" class="col-sm-3 col-form-label"><b>JENIS DIPA</b></label>
                <div class="col-sm-9">
                  <input type="text" name="jenis_dipa" class="form-control" id="jenis_dipa" value="{{ $laporanAnggaran->jenis_dipa }}" disabled>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="dipa_kegiatan" class="col-sm-3 col-form-label"><b>DIPA KEGIATAN</b></label>
                <div class="col-sm-9">
                  <input type="text" name="dipa_kegiatan" class="form-control" id="dipa_kegiatan" value="{{ $laporanAnggaran->dipa_kegiatan }}" disabled>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="uraianKegiatan" class="col-sm-3 col-form-label"><b>URAIAN KEGIATAN</b></label>
                <div class="col-sm-9">
                  <input type="text" name="uraianKegiatan" class="form-control" id="uraianKegiatan" value="{{ $laporanAnggaran->kode_kegiatan }}-{{ $laporanAnggaran->uraian_kegiatan }}" disabled>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="volume" class="col-sm-3 col-form-label"><b>VOLUME</b></label>
                <div class="col-sm-9">
                  <input type="text" name="volume" class="form-control" id="volume" value="{{ $laporanAnggaran->volume }}" disabled>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="harga_satuan" class="col-sm-3 col-form-label"><b>HARGA SATUAN</b></label>
                <div class="col-sm-9">
                  <input type="text" name="harga_satuan" class="form-control" id="harga_satuan" value="{{ number_format($laporanAnggaran->harga_satuan, 0, '.', '.') }}" disabled>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="pagu" class="col-sm-3 col-form-label"><b>PAGU</b></label>
                <div class="col-sm-9">
                  <input type="text" name="pagu" class="form-control" id="pagu" value="{{ number_format($laporanAnggaran->pagu, 0, '.', '.') }}" disabled>
                </div>
            </div>
            <div class="mb-3 row">
              <label for="realisasi" class="col-sm-3 col-form-label"><b>REALISASI ANGGARAN</b></label>
              <div class="col-sm-9">
                <input type="number" name="realisasi" id="realisasi" class="form-control" autofocus>
                  @error('realisasi')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
                  <div class="form-text">(*Tanpa karakter - contoh: 1000000)</div>
              </div>
            </div>
            <div class="row">
                <label for="tanggal" class="col-sm-3 col-form-label"><b>TANGGAL</b></label>
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
            <div class="row mt-5">
                <button type="submit" class="btn btn-primary btn-block">SIMPAN</button>
            </div>
        </form>
    </div>
@endsection