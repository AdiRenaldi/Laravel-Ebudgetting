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
        Schema::create('staf_anggaran', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_dipa');
            $table->Integer('total_anggaran');
            $table->Integer('total_pemakaian');
            $table->Integer('sisa_anggaran');
            $table->dateTime('created');
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
        Schema::dropIfExists('staf_anggaran');
    }
};
