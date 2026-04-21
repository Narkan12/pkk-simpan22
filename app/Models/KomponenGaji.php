<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomponenGaji extends Model
{
    protected $table = 'komponen_gaji';
    protected $fillable = ['id_jabatan', 'kode_komponen', 'nama_komponen', 'jenis', 'tipe_nominal', 'nominal'];

    public function getNominalLabel(){
        return match ($this->tipe_nominal){
            'fixed' => 'Rp',
            'percent' => '%',
            default => '-'
        };
    }
}
