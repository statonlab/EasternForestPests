<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonName extends Model
{
    protected $fillable = [
        'names',
        'pest_id'
    ];

    public function pest(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Pest::class);
    }
}
