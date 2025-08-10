<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kegiatan extends Model
{
     protected $guarded = ['id'];

     public function satker(): BelongsTo
     {
          return $this->belongsTo(Skpd::class, 'kd_satker', 'kd_satker');
     }

     public function program(): BelongsTo
     {
          return $this->belongsTo(Program::class, 'kd_program', 'kd_program');
     }

      public function subkegiatans(): HasMany
    {
        return $this->hasMany(SubKegiatan::class, 'kd_kegiatan', 'kd_kegiatan');
    }
     // public function subkegiatan()
     // {
     //      return $this->belongsTo(SubKegiatan::class, 'kd_kegiatan', 'kd_kegiatan');
     // }
}
