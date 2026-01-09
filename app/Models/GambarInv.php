<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Inventarisasi;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GambarInv extends Model
{
    protected $table = 'gambar_inv';
    protected $guarded = [];
    public function inventarisasi(): BelongsTo
    {
        return $this->belongsTo(Inventarisasi::class, 'inv_id');
    }
}
