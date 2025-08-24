<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class SubKegiatan extends Model
{
     protected $guarded = ['id'];

     public function kegiatan(): BelongsTo
     {
          return $this->belongsTo(Kegiatan::class, 'kd_kegiatan', 'kd_kegiatan');
     }

     public function indikatorsubkegiatan(): HasMany
     {
          return $this->hasMany(IndikatorSubKegiatan::class,  'kd_subkegiatan','kd_subkegiatan_str');
     }

        public function indikatorsubkegiatanNull(): BelongsTo
     {

          return $this->belongsTo(IndikatorSubKegiatan::class, 'kd_subkegiatan_str', 'subkeg_before');
     }

}
