<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    //
    protected $guarded = ['id'];
    protected $cast = [
        'tags_sasaran' => 'json',
        'tags_satker' => 'json',
    ];

}
