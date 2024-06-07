@extends('layouts.mainlayout')

@section('title', 'Edit Kebutuhan Anggaran')

@section('content')
    <h1 class="text-center">EDIT KEBUTUHAN ANGGARAN</h1>
    <div class="col-8  offset-2 mt-5">
        <form action="/update-kebutuhan-anggaran/{{ $anggaran->slug }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            @if ($anggaran->respon == 'ditolak')
                <div class="mb-3 row">
                    <label class="form-label col-sm-3 col-form-label"><b>CATATAN REVISI</b></label>
                    <div class="col-sm-9">
                        <textarea class="form-control text-uppercase text-danger" cols="30" disabled>{{ $anggaran->catatan }}</textarea>
                    </div>
                </div>
            @endif

            <input type="hidden" name="staf_id" value="{{ Auth::user()->id; }}">
            <div class="mb-3 row">
                <label for="jenis_dipa" class="col-sm-3 col-form-label"><b>JENIS DIPA</b></label>
                <div class="col-sm-9">
                  <input type="text" name="jenis_dipa" class="form-control" id="jenis_dipa" value="{{ $anggaran->jenis_dipa }}" readonly>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="program_kegiatan" class="col-sm-3 col-form-label"><b>PROGRAM KEGIATAN</b></label>
                <div class="col-sm-9">
                    <select class="form-select @error('program_kode') is-invalid @enderror" name="program_kode" id="program_kegiatan" aria-label="Default select example">
                        <option value="{{ $anggaran->program_kode }}">{{ $anggaran->program_kode }}</option>
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
                <label for="dipa_kegiatan" class="col-sm-3 col-form-label"><b>DIPA KEGIATAN</b></label>
                <div class="col-sm-9">
                    <select class="form-select @error('dipa_kode') is-invalid @enderror" name="dipa_kode" id="dipa_kegiatan" aria-label="Default select example">
                        <option value="{{ $anggaran->dipa_kode }}">{{ $anggaran->dipa_kode }}</option>
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
                  <input type="text" name="kode" class="form-control @error('kode') is-invalid @enderror" id="kode" value="{{ old('kode', $anggaran->kode)}}">
                    @error('kode')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>   
            <div class="mb-3 row">
                <label for="uraian" class="col-sm-3 col-form-label"><b>URAIAN</b></label>
                <div class="col-sm-9">
                  <input type="text" name="uraiaan" class="form-control @error('uraiaan') is-invalid @enderror" id="uraian" value="{{ old('uraiaan',$anggaran->uraiaan) }}">
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
                  <input type="text" name="volume" class="form-control @error('volume') is-invalid @enderror" id="volume" value="{{ old('volume',$anggaran->volume) }}">
                    @error('volume')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row  g-0">
                <div class="col-9 ">
                    <div class="mb-3 row g-0">
                        <label for="harga_satuan" class="col-sm-3 col-form-label"><b>HARGA SATUAN</b></label>
                        <div class="col-sm-9">
                          <input type="number" name="harga_satuan" class="form-control  @error('harga_satuan') is-invalid @enderror" id="harga_satuan" value="{{ old('harga_satuan',$anggaran->harga_satuan) }}" style="margin-left: 62px;">
                            @error('harga_satuan')
                                <div class="invalid-feedback" style="margin-left: 62px;">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-text" style="margin-left: 62px;">(*Tanpa karakter - contoh: 1000000)</div>
                        </div>
                    </div>
                </div>
                <div class="col-3 d-flex justify-content-end">
                    <div class="mb-3 w-50">
                        <select name="list" class="form-select @error('list') is-invalid @enderror" aria-label="Default select example" value="{{ old('list',$anggaran->list) }}">
                            <option value="{{ $anggaran->list }}">{{ $anggaran->list }}</option>
                            @if ($anggaran->list == 'OG')
                                <option value="OJ">OJ</option>
                            @else  
                                <option value="OG">OG</option>  
                            @endif
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
                  <input type="text" name="pagu" class="form-control @error('pagu') is-invalid @enderror" id="pagu" value="{{ old('pagu',$anggaran->pagu) }}" readonly>
                    @error('pagu')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mt-4">
                @if (request()->route()->uri == 'edit-kebutuhan-anggaran/{slug}')
                    <button type="submit" class="btn btn-success">SIMPAN</button>
                @endif
                
                <button type="reset" class="btn btn-danger">RESET</button>
                @if (request()->route()->uri == 'edit-revisi/{slug}')
                    <button type="submit" class="btn btn-primary">AJUKAN</button>
                @endif
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


    var dipaKegiatan = document.getElementById("dipa_kegiatan");
    var uniqueValues = Array.from(new Set(Array.from(dipaKegiatan.options).map(option => option.value)));
    
    // Kosongkan elemen select
    dipaKegiatan.innerHTML = "";
    
    // Tambahkan nilai unik ke elemen select
    uniqueValues.forEach(function(value) {
        var option = document.createElement("option");
        option.value = value;
        option.text = value;
        dipaKegiatan.add(option);
    });
</script>    
@endsection