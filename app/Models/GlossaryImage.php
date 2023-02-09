<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlossaryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'size',
        'caption',
        'data',
        'disk',
        'glossary_id',
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
        return $this->belongsTo(Glossary::class);
    }
}
