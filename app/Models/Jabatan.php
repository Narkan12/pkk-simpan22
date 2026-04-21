<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatan';
    protected $fillable = ['kode_jabatan', 'nama_jabatan', 'level', 'gaji_pokok', 'tunjangan'];

    public function komponenGaji()
    {
        return $this->hasMany(KomponenGaji::class, 'id_jabatan');
    }

    public function employees()
    {
        return $this->hasMany(Employees::class, 'id_jabatan');
    }
}
