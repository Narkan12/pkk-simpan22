<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cuti extends Model
{
    protected $table = 'cuti';

    protected $fillable = [
        'id_pegawai', 'jenis_cuti', 'tanggal_mulai', 'tanggal_selesai', 'alasan', 'status',
    ];

    protected $casts = [
        'tanggal_mulai'   => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Employees::class, 'id_pegawai');
    }
}
