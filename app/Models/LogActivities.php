<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogActivities extends Model
{
    protected $table = 'activity_logs';
    protected $fillable = ['nama_lengkap', 'deskripsi'];
}
