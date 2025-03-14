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
            $table->string('status')->default('tidak_ajukan')->after('pagu');
            $table->text('respon')->nullable()->after('status');
            $table->text('revisi')->nullable()->after('respon');
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
            $table->dropColumn('status');
            $table->dropColumn('revisi');
            $table->dropColumn('respon');
        });
    }
};
