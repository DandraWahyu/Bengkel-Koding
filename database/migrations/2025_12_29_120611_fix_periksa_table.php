<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('periksa', function (Blueprint $table) {
            $table->text('catatan')->nullable()->change();
            // HAPUS baris tgl_periksa
        });
    }

    public function down()
    {
        Schema::table('periksa', function (Blueprint $table) {
            $table->string('catatan')->nullable()->change();
        });
    }
};
