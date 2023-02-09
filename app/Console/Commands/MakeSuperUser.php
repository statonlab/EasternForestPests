<?php

namespace App\Console\Commands;

use App\Models\SuperUser;
use App\Models\User;
use Illuminate\Console\Command;

class MakeSuperUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'superuser:make {email : The user\'s email address}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Changes a user role to a super user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = User::where('email', $this->argument('email'))->first();
        if (! $user) {
            $this->error('Unable to fine user with the given email.');

            return;
        }

        SuperUser::create([
            'user_id' => $user->id,
        ]);

        $this->info("$user->name has been made a super user.");
    }
}
