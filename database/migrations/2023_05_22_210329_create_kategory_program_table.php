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
        Schema::create('kategory_program', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dipa_id');
            $table->foreign('dipa_id')->references('id')->on('dipa');
            $table->unsignedBigInteger('program_id');
            $table->foreign('program_id')->references('id')->on('program_kegiatan');
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
        Schema::dropIfExists('kategory_program');
    }
};
