<?php


namespace App\Http\Controllers\Traits;

use App\Models\Chapter;
use Illuminate\Http\JsonResponse;

trait HandleChapters
{
    protected function makeChapters()
    {
        $chapters = [
            [1, 'Foliage Diseases', 10, '#70be73'],
            [2, 'Root Diseases', 20, '#765341'],
            [3, 'Diseases Stem and Trunk', 22, '#87CEEB'],
            [4, 'Diseases Vascular', 22, '#765341'],
            [5, 'Insects and Mites - Stems and Trunk', 54, '#ff8c69'],
            [6, 'Galls', 80, '#70be73'],
            [7, 'Insects and Mites Foliage Feeders', 86, '#765341'],
            [8, 'Foliage Diseases', 144, '#70be73'],
            [9, 'Diseases Roots', 152, '#765341'],
            [10, 'Diseases Stem and Trunk', 154, '#e8e337'],
            [11, 'Insects and Mites Foliage', 158, '#70be73'],
            [12, 'Insects and Mites Stems and Trunks', 178, '#A020F0'],
        ];

        foreach ($chapters as $chapter) {
            Chapter::updateOrCreate([
                'number' => $chapter[0],
                'title' => $chapter[1],
            ], [
                'page_number' => $chapter[2],
                'color' => $chapter[3]
            ]);
        }
    }
}