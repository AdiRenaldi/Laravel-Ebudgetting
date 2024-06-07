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
        Schema::create('revisi_dana_staf', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dipa_id');
            $table->foreign('dipa_id')->references('id')->on('dipa');
            $table->unsignedBigInteger('staf_id');
            $table->foreign('staf_id')->references('id')->on('staf');
            $table->bigInteger('dana_awal')->default(0);
            $table->bigInteger('penambahan_dana')->default(0);
            $table->bigInteger('pengurangan_dana')->default(0);
            $table->bigInteger('dana_sekarang')->default(0);
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
        Schema::dropIfExists('revisi_dana_staf');
    }
};
