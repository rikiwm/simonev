<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bidang extends Model
{
    protected $guarded = ['id'];

    public function kegiatans(): HasMany
    {
            return $this->hasMany(Program::class, 'kd_bidang_str', 'kode_bidang');
    }
}