<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IndikatorProgram extends Model
{
    protected $guarded = ['id'];
     protected $cast = [
        'tag' => 'json',
    ];

    
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'kd_program', 'kd_program');
    }
}
