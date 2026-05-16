<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jabatan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_jabatan', 20)->unique();
            $table->string('nama_jabatan', 100);
            $table->unsignedTinyInteger('level');
            $table->decimal('gaji_pokok', 15, 2)->default(0);
            $table->decimal('tunjangan', 15, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('departemen', function (Blueprint $table) {
            $table->id();
            $table->string('kode_departemen', 20)->unique();
            $table->string('nama_departemen', 100);
            $table->string('kepala_departemen', 100)->nullable();
            $table->string('lokasi', 150)->nullable();
            $table->timestamps();
        });

        Schema::create('golongan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_golongan', 20)->unique();
            $table->string('nama_golongan', 100);
            $table->string('pangkat', 100);
            $table->string('ruang', 10);
            $table->text('eselon')->nullable();
            $table->timestamps();
        });

        Schema::create('status_pegawai', function (Blueprint $table) {  
            $table->id();
            $table->string('kode_status', 20)->unique();
            $table->string('nama_status', 100);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('pendidikan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pendidikan', 20)->unique();
            $table->string('jenjang', 150);
            $table->unsignedTinyInteger('lama_studi');
            $table->string('deskripsi', 150)->nullable();
            $table->timestamps();
        });

        Schema::create('komponen_gaji', function (Blueprint $table) {
            $table->id();
             $table->foreignId('id_jabatan')->nullable()->constrained('jabatan')->onDelete('cascade');
            $table->string('kode_komponen', 20)->unique();
            $table->string('nama_komponen', 100);
            $table->enum('jenis', ['penghasilan', 'potongan']);
            $table->enum('tipe_nominal', ['fixed', 'percent']);  
            $table->decimal('nominal', 15, 2)->default(0);
            $table->timestamps();
           
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komponen_gaji');
        Schema::dropIfExists('pendidikan');
        Schema::dropIfExists('status_pegawai');
        Schema::dropIfExists('golongan');
        Schema::dropIfExists('departemen');
        Schema::dropIfExists('jabatan');
    }
};