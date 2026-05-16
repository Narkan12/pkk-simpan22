<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gaji', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pegawai')->constrained('employees')->onDelete('cascade');
            $table->tinyInteger('bulan'); // 1-12
            $table->year('tahun');
            $table->bigInteger('gaji_pokok')->default(0);
            $table->bigInteger('tunjangan')->default(0);
            $table->bigInteger('potongan')->default(0);
            $table->bigInteger('total_gaji')->storedAs('gaji_pokok + tunjangan - potongan');
            $table->enum('status_bayar', ['Belum Dibayar', 'Sudah Dibayar'])->default('Belum Dibayar');
            $table->date('tanggal_bayar')->nullable();
            $table->timestamps();

            $table->unique(['id_pegawai', 'bulan', 'tahun']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaji');
    }
};
