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
        Schema::table('laporan_anggaran', function (Blueprint $table) {
            $table->unsignedBigInteger('dipa_id')->after('bidang');
            $table->foreign('dipa_id')->references('id')->on('dipa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laporan_anggaran', function (Blueprint $table) {
            $table->dropForeign('laporan_anggaran_dipa_id_foreign');
            $table->dropColumn('dipa_id');
        });
    }
};
