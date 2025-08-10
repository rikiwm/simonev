<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubKegiatan extends Model
{
     protected $guarded = ['id'];

     public function kegiatan(): BelongsTo
     {
          return $this->belongsTo(Kegiatan::class, 'kd_kegiatan', 'kd_kegiatan');
     }

     public function indikatorsubkegiatan(): BelongsTo
     {
          return $this->belongsTo(IndikatorSubKegiatan::class, 'kd_subkegiatan_str', 'kd_subkegiatan');
     }

}
