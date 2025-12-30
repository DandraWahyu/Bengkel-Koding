<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwal_periksa', function (Blueprint $table) {
            $table->foreignId('id_poli')
                  ->after('id_dokter')
                  ->constrained('poli') // ✅ NAMA TABEL BENAR
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('jadwal_periksa', function (Blueprint $table) {
            $table->dropForeign(['id_poli']);
            $table->dropColumn('id_poli');
        });
    }
};
