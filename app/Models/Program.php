<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
       protected $guarded = ['id'];

       public function satker()
       {
              return $this->belongsTo(Skpd::class, 'kd_satker', 'kd_satker');
       }

       public function bidang(): BelongsTo
       {
              return $this->belongsTo(Bidang::class, 'kd_bidang_str', 'kode_bidang');
       }

       public function kegiatans(): HasMany
       {
              return $this->hasMany(Kegiatan::class, 'kd_program', 'kd_program');
       }

       public function indikatorprogram(): BelongsTo
       {
              return $this->belongsTo(IndikatorProgram::class, 'kd_program', 'kd_program');
       }


}
