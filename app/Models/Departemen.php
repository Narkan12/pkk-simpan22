<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departemen extends Model
{
    protected $table = 'departemen';
    protected $fillable = ['kode_departemen', 'nama_departemen', 'kepala_departemen', 'lokasi'];

    public function employees(): HasMany
    {
        return $this->hasMany(Employees::class, 'id_departemen');
    }
}
