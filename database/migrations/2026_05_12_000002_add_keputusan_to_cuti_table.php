<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cuti', function (Blueprint $table) {
            $table->text('catatan_keputusan')->nullable()->after('nomor_surat');
            $table->string('diputuskan_oleh')->nullable()->after('catatan_keputusan');
            $table->timestamp('diputuskan_pada')->nullable()->after('diputuskan_oleh');
        });
    }

    public function down(): void
    {
        Schema::table('cuti', function (Blueprint $table) {
            $table->dropColumn(['catatan_keputusan', 'diputuskan_oleh', 'diputuskan_pada']);
        });
    }
};
