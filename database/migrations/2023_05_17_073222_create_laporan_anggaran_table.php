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
        Schema::create('laporan_anggaran', function (Blueprint $table) {
            $table->id();
            $table->string('staf');
            $table->string('bidang');
            $table->string('jenis_dipa');
            $table->string('dipa_kegiatan');
            $table->string('kode_kegiatan');
            $table->string('uraian_kegiatan');
            $table->string('slug');
            $table->integer('volume');
            $table->string('list');
            $table->bigInteger('harga_satuan');
            $table->bigInteger('pagu');
            $table->string('spn');
            $table->string('realisasi');
            $table->bigInteger('total');
            $table->bigInteger('sisa anggaran');
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
        Schema::dropIfExists('laporan_anggaran');
    }
};
