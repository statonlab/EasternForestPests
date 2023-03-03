<?php

namespace Database\Seeders;

use App\Http\Controllers\Traits\HandleChapters;
use App\Models\SuperUser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use HandleChapters;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Noah Caldwell',
            'email' => 'noahgreycaldwell@gmail.com',
            'password' => Hash::make('airhorns_flying17$')
        ]);

        SuperUser::create([
            'user_id' => 1
        ]);

        $this->makeChapters();
    }
}
