<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
     protected $guarded = ['id'];

     // public function satker()
     // {
     //      return $this->belongsTo(Skpd::class, 'kd_satker', 'kd_satker');
     // }

     public function program()
     {
          return $this->belongsTo(Program::class, 'kd_program', 'kd_program');
     }

     public function subkegiatan()
     {
          return $this->belongsTo(SubKegiatan::class, 'kd_kegiatan', 'kd_kegiatan');
     }
}
