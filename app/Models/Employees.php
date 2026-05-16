<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Employees extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id_user',
        'NIK',
        'NIP',
        'foto',
        'nama_lengkap',
        'jenis_kelamin',
        'tanggal_lahir',
        'tempat_lahir',
        'agama',
        'alamat',
        'no_telp',
        'status_pernikahan',
        'jenis_pegawai',
        'id_jabatan',
        'id_departemen',
        'id_golongan',
        'id_status',
        'id_pendidikan',
        'tanggal_masuk',
    ];

   
    public function getFotoUrlAttribute(): string
    {
        if (!$this->foto) {
            return '';
        }

        return asset('storage/' . $this->foto);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }

    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'id_departemen');
    }

    public function golongan()
    {
        return $this->belongsTo(Golongan::class, 'id_golongan');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }

    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class, 'id_pendidikan');
    }
}
