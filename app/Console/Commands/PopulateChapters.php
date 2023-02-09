<?php

namespace App\Console\Commands;

use App\Models\Chapter;
use Illuminate\Console\Command;

class PopulateChapters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chapters:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populates the chapters table.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $chapters = [
            [1, 'Foliage Diseases', 10],
            [2, 'Root Diseases', 20],
            [3, 'Diseases Stem and Trunk', 22],
            [4, 'Diseases Vascular', 22],
            [5, 'Insects and Mites - Stems and Trunk', 54],
            [6, 'Galls', 80],
            [7, 'Insects and Mites Foliage Feeders', 86],
            [8, 'Foliage Diseases', 144],
            [9, 'Diseases Roots', 152],
            [10, 'Diseases Stem and Trunk', 154],
            [11, 'Insects and Mites Foliage', 158],
            [12, 'Insects and Mites Stems and Trunks', 178]
        ];

        foreach ($chapters as $chapter) {
            Chapter::create([
                'number' => $chapter[0],
                'title' => $chapter[1],
                'page_number' => $chapter[2]
            ]);
        }

        return Command::SUCCESS;
    }
}
