<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RealisasiKinerja extends Model
{
   //
   protected $guarded = ['id'];

   public function indikatorsubkeg()
   {
      return $this->belongsTo(IndikatorSubKegiatan::class, 'indikator_sub_kegiatan_id');
   }
}
