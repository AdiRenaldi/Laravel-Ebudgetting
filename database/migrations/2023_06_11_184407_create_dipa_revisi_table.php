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
        Schema::create('dipa_revisi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dipa_id');
            $table->foreign('dipa_id')->references('id')->on('dipa');
            $table->bigInteger('anggaran_awal');
            $table->bigInteger('anggaran_baru');
            $table->bigInteger('total_terpakai');
            $table->bigInteger('sisa_anggaran');
            $table->string('tanggal');
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
        Schema::dropIfExists('dipa_revisi');
    }
};
