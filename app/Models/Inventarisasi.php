<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KartuRuang;
use App\Models\GambarInv;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventarisasi extends Model
{
    protected $table = 'inventarisasi';
    protected $guarded = [];
    public function kartu_ruang(): BelongsTo
    {
        return $this->belongsTo(KartuRuang::class);
    }
    public function gambar_inv(): HasMany
    {
        return $this->hasMany(GambarInv::class, 'inv_id');
    }
}
