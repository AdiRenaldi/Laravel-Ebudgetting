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
        Schema::table('staf_anggaran', function (Blueprint $table) {
            $table->unsignedBigInteger('staf_id')->after('jenis_dipa');
            $table->foreign('staf_id')->references('id')->on('staf');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('staf_anggaran', function (Blueprint $table) {
            $table->dropForeign('staf_anggaran_staf_id_foreign');
            $table->dropColumn('staf_id');
        });
    }
};
