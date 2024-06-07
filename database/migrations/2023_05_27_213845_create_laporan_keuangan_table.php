<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_keuangan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staf_id');
            $table->foreign('staf_id')->references('id')->on('staf');
            $table->unsignedBigInteger('dipa_id');
            $table->foreign('dipa_id')->references('id')->on('dipa');
            $table->string('staf');
            $table->string('program_kegiatan');
            $table->string('jenis_dipa');
            $table->string('dipa_kegiatan');
            $table->string('kegiatan_staf');
            $table->string('volume');
            $table->string('harga_satuan');
            $table->string('pagu');
            $table->string('realisasi');
            $table->string('sisa_anggaran');
            $table->integer('tanggal');
            $table->string('bulan');
            $table->integer('tahun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan_keuangan');
    }
};
