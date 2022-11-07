<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('forum_messages')->insert([
            'forum' => 'sessions-autonomes',
            'author' => 'Arthaud Proust',
            'author_uuid' => '90cffc79-f4ca-472d-b718-cb3b6136bead',
            'content' => 'lorem ipsum',
        ]);
    }
}
