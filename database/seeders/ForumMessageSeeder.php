<?php

namespace Database\Seeders;

use App\Models\ForumMessage;
use App\Models\User;
use Illuminate\Database\Seeder;

class ForumMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ForumMessage::factory()
            ->count(50)
            ->create();

        ForumMessage::factory()
            ->for(User::firstWhere('email', 'admin@email.com'))
            ->create();
    }
}
