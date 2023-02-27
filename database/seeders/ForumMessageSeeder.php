<?php

namespace Database\Seeders;

use App\Models\ForumMessage;
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
        $date = now()->subYear();
        for ($i = 0; $i < 300; $i++) {
            ForumMessage::factory()
                ->create([
                    'content' => $i,
                    'created_at' => $date->copy()->addSeconds($i)
                ]);
        }

//        ForumMessage::factory()
//            ->count(50)
//            ->create();

//        ForumMessage::factory()
//            ->for(User::firstWhere('email', 'proust@arthaud.dev'))
//            ->create();
    }
}
