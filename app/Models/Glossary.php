<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Glossary extends Model
{
    use HasFactory;

    /**
     * For the sake of brevity, this model is named Glossary.php, though GlossaryEntry.php would be more descriptive.
     * Each Glossary is one entry in the Eastern Forest Pests book.
     * @var string[]
     */
    protected $fillable = [
        'term',
        'description',
    ];

    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PestImage::class);
    }
}
