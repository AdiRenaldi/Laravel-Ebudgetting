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
        Schema::create('dipa', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_dipa');
            $table->string('slug')->nullable();
            $table->string('anggaran');
            $table->string('kegiatan');
            $table->string('status')->default('tidak_ajukan');
            $table->string('respon')->nullable();
            $table->string('revisi')->nullable();
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
        Schema::dropIfExists('dipa');
    }
};
