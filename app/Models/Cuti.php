<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cuti extends Model
{
    protected $table = 'cuti';

    protected $fillable = [
        'id_pegawai', 'jenis_cuti', 'tanggal_mulai', 'tanggal_selesai', 'alasan',
        'status', 'nomor_surat', 'catatan_keputusan', 'diputuskan_oleh', 'diputuskan_pada',
    ];

    protected $casts = [
        'tanggal_mulai'    => 'date',
        'tanggal_selesai'  => 'date',
        'diputuskan_pada'  => 'datetime',
    ];

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Employees::class, 'id_pegawai');
    }
}
