<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndikatorSubKegiatan extends Model
{
   protected $guarded = ['id'];
     protected $cast = [
        'tag' => 'json',
    ];
}
