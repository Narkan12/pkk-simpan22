<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->nullable()->constrained('users')->nullOnDelete();
            $table->string('NIK', 20)->unique();
            $table->string('NIP', 30)->unique();
            $table->string('foto')->nullable();
            $table->string('nama_lengkap', 150);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tanggal_lahir')->nullable();
            $table->string('tempat_lahir', 100)->nullable();
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Aliran Kepercayaan'])->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_telp', 20)->nullable();
            $table->string('status_pernikahan')->nullable();
            $table->string('jenis_pegawai')->nullable();
            $table->foreignId('id_jabatan')->nullable()->constrained('jabatan')->nullOnDelete();
            $table->foreignId('id_departemen')->nullable()->constrained('departemen')->nullOnDelete();
            $table->foreignId('id_golongan')->nullable()->constrained('golongan')->nullOnDelete();
            $table->foreignId('id_status')->nullable()->constrained('status_pegawai')->nullOnDelete();
            $table->foreignId('id_pendidikan')->nullable()->constrained('pendidikan')->nullOnDelete();
            $table->date('tanggal_masuk');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};