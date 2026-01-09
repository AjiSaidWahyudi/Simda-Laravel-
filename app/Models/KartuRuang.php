<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Inventarisasi;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KartuRuang extends Model
{
    protected $table = 'kartu_ruang';
    protected $guarded = [];
    public function inventarisasi(): HasMany
    {
        return $this->hasMany(Inventarisasi::class);
    }
}
