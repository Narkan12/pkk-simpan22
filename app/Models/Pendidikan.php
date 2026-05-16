<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    protected $table = 'pendidikan';
    protected $fillable = ['kode_pendidikan', 'jenjang', 'lama_studi', 'deskripsi'];
}
