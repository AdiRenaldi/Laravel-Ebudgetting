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
        Schema::table('kebutuhan_anggaran', function (Blueprint $table) {
            $table->unsignedBigInteger('dipa_id')->after('staf_id');
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
        Schema::table('kebutuhan_anggaran', function (Blueprint $table) {
            $table->dropForeign('kebutuhan_anggaran_dipa_id_foreign');
            $table->dropColumn('dipa_id');
        });
    }
};
