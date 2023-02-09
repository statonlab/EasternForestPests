<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pest extends Model
{
    use HasFactory;

    /**
     * The Pest.php model is used for both pests and diseases, since the two share so much info.
     * @var string[]
     */
    protected $fillable = [
        'common_name',
        'scientific_name',
        'description',
        'chapter',
        'major_hosts',
        'key_features',
        'control',
        'other_info_title',
        'other_info_body',
        'pest_type',
        'affects_deciduous',
        'affects_conifer',
        'is_disease',
        'is_pest',
        'disease_visiblity',
        'feeding_target'
    ];

    protected $casts = [
        'scientific_name'
    ];

    public function chapter(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }

    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PestImage::class);
    }
}
