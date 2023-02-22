<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $fillable = [
        'number',
        'title',
        'page_number',
        'color'
    ];

    public function pests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Pest::class);
    }
}