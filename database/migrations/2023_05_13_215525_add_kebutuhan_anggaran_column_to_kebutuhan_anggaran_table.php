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
            $table->string('jenis_dipa')->after('staf_id');
            $table->string('dipa_kode')->after('jenis_dipa');
            $table->string('dipa_kegiatan')->after('dipa_kode');
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
            $table->dropColumn('jenis_dipa');
            $table->dropColumn('dipa_kode');
            $table->dropColumn('dipa_kegiatan');
        });
    }
};
