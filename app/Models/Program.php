<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
       protected $guarded = ['id'];

       public function satker()
       {
              return $this->belongsTo(Skpd::class, 'kd_satker', 'kd_satker');
       }

        public function bidang()
       {
              return $this->belongsTo(Bidang::class, 'kd_bidang_str', 'kode_bidang');
       }
}
