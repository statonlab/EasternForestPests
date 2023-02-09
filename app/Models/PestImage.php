<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PestImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'size',
        'caption',
        'data',
        'disk',
        'pest_id',
        'is_thumbnail'
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function url(): string
    {
        return "/web/pest-image/{$this->id}";
    }

    public function post(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Pest::class);
    }
}
