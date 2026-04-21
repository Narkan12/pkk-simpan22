<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status_pegawai';
    protected $fillable = ['kode_status', 'nama_status', 'deskripsi'];
}
