<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pest extends Model
{
    /**
     * The Pest.php model is used for both pests and diseases, since the two share so much info.
     * @var string[]
     */
    protected $fillable = [
        'description',
        'chapter',
        'pest_type',
        'is_pest',
        'is_disease',
        'affects_deciduous',
        'affects_conifer',
        'visible_in_roots',
        'visible_in_trunk',
        'visible_in_foliage',
        'feeding_target',
        'major_hosts',
        'key_features',
        'control',
        'other_info_title',
        'other_info_body',
    ];

    public function commonNames(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CommonName::class);
    }

    public function scientificNames(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ScientificName::class);
    }

    public function chapter(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }

    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PestImage::class);
    }
}
