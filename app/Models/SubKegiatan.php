<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubKegiatan extends Model
{
     protected $guarded = ['id'];

     public function kegiatan()
     {
          return $this->belongsTo(Kegiatan::class, 'kd_kegiatan', 'kd_kegiatan');
     }
}
