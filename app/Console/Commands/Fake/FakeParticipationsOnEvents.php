<?php

namespace App\Console\Commands\Fake;

use App\Models\Event;
use App\Models\User;
use Illuminate\Console\Command;

class FakeParticipationsOnEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fake:participations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create fake participations on events';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach (User::cursor() as $user) {
            $user->events()->attach(Event::inRandomOrder()->first());
        }

        return Command::SUCCESS;
    }
}
