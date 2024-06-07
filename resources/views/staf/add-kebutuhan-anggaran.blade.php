@extends('layouts.mainlayout')

@section('title', 'Tambah Kebutuhan Anggaran')

@section('content')
    <h1 class="text-center">TAMBAH KEBUTUHAN ANGGARAN</h1>
    <div class="col-8  offset-2 mt-5">
        <form action="/tambah-kebutuhan-anggaran" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="staf_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="dipa_id" value="{{ $dipaKegiatan->id }}">
            <div class="mb-3 row">
                <label for="jenis_dipa" class="col-sm-3 col-form-label"><b>JENIS DIPA</b></label>
                <div class="col-sm-9">
                  <input type="text" name="jenis_dipa" class="form-control" id="jenis_dipa" value="{{ $dipaKegiatan->jenis_dipa }}" readonly>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="program_kegiatan" class="col-sm-3 col-form-label"><b>PROGRAM</b></label>
                <div class="col-sm-9">
                    <select class="form-select @error('program_kode') is-invalid @enderror" name="program_kode" id="program_kegiatan" aria-label="Default select example">
                        <option selected disabled>Program</option>
                        @foreach ($dipaKegiatan->categoriesProgram as $item)
                            <option value="{{ $item->kode }}-{{ $item->program_kegiatan }}">{{ $item->kode }}-{{ $item->program_kegiatan }}</option>
                        @endforeach
                    </select>
                    @error('program_kode')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="dipa_kegiatan" class="col-sm-3 col-form-label"><b>KEGIATAN</b></label>
                <div class="col-sm-9">
                    <select class="form-select @error('dipa_kode') is-invalid @enderror" name="dipa_kode" id="dipa_kegiatan" aria-label="Default select example">
                        <option selected disabled>Kegiatan</option>
                        @foreach ($dipaKegiatan->catrgoriesKegiatan as $item)
                            <option value="{{ $item->kode }}-{{ $item->kegiatan }}">{{ $item->kode }}-{{ $item->kegiatan }}</option>
                        @endforeach
                    </select>
                    @error('dipa_kode')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div> 


            <div class="mb-3 row">
                <label for="kode" class="col-sm-3 col-form-label"><b>KODE KEGIATAN</b></label>
                <div class="col-sm-9">
                  <input type="text" name="kode" class="form-control @error('kode') is-invalid @enderror" id="kode" value="{{ old('kode') }}">
                    @error('kode')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>   
            <div class="mb-3 row">
                <label for="uraian" class="col-sm-3 col-form-label"><b>URAIAN KEGIATAN</b></label>
                <div class="col-sm-9">
                  <input type="text" name="uraiaan" class="form-control @error('uraiaan') is-invalid @enderror" id="uraian" value="{{ old('uraiaan') }}">
                    @error('uraiaan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="volume" class="col-sm-3 col-form-label"><b>VOLUME</b></label>
                <div class="col-sm-9">
                  <input type="text" name="volume" class="form-control @error('volume') is-invalid @enderror" id="volume" value="{{ old('volume') }}">
                    @error('volume')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <div class="mb-3 row">
                        <label for="harga_satuan" class="col-3 col-form-label"><b>HARGA SATUAN</b></label>
                        <div class="col-9 g-0">
                          <input type="text" name="harga_satuan" class="form-control  @error('harga_satuan') is-invalid @enderror" id="harga_satuan" value="{{ old('harga_satuan') }}" style="margin-left: 60px;">
                            @error('harga_satuan')
                                <div class="invalid-feedback" style="margin-left: 60px;">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-text" style="margin-left: 60px;">(*Tanpa karakter - contoh: 1000000)</div>
                        </div>
                    </div>
                </div>
                <div class="col-2 d-flex justify-content-end">
                    <div class="mb-3 w-50">
                        <select name="list" class="form-select @error('list') is-invalid @enderror" aria-label="Default select example" value="{{ old('list') }}">
                            <option selected disabled>list</option>
                            <option value="OG">OG</option>
                            <option value="OJ">OJ</option>
                          </select>
                        @error('list')
                            <div class="invalid-feedback " style="margin-left: 5px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="pagu" class="col-sm-3 col-form-label"><b>PAGU</b></label>
                <div class="col-sm-9">
                  <input type="number" name="pagu" class="form-control" id="pagu" value="{{ old('pagu') }}" readonly>
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
            <div class="mt-5">
                <button type="submit" class="btn btn-primary">SIMPAN</button>
                <button type="reset" class="btn btn-danger">BATAL</button>
            </div>
        </form>
    </div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#volume, #harga_satuan').on('input', function() {
            var volumeValue = parseFloat($('#volume').val());
            var hargaValue = parseFloat($('#harga_satuan').val());
            var result = volumeValue * hargaValue;
            if (!isNaN(result)) {
                $('#pagu').val(result);
            }
        });
    });
</script>

@endsection