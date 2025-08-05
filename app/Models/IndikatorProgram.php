<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndikatorProgram extends Model
{
    protected $guarded = ['id'];
     protected $cast = [
        'tag' => 'json',
    ];
}
