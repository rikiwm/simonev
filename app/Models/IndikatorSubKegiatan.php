<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IndikatorSubKegiatan extends Model
{
   protected $guarded = ['id'];
     protected $cast = [
        'tag' => 'json',
    ];
    
     // public function subkegiatan(): BelongsTo
     // {
     //      return $this->belongsTo(SubKegiatan::class, 'kd_subkegiatan_str', 'kd_subkegiatan');
     // }
}
