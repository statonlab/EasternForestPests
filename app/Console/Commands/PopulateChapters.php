<?php

namespace App\Console\Commands;

use App\Http\Controllers\Traits\HandleChapters;
use Illuminate\Console\Command;

class PopulateChapters extends Command
{
    use HandleChapters;
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
    public function handle(): int
    {
        $this->makeChapters();

        return Command::SUCCESS;
    }
}
