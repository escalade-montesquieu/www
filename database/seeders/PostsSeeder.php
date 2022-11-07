<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blog_posts')->insert([
            'blog' => 'session-au-lycee',
            'title' => 'Session 12h-14h',
            'location' => 'Lycée Montesquieu',
            'content' => 'Lorem ipsum',
            'datetime' => '2020-10-10',
            'maxplaces' => 17,
            'availables' => '{}',
            'unavailables' => '[]',
        ]);

        DB::table('blog_posts')->insert([
            'blog' => 'session-a-ginko',
            'title' => 'Session à Ginko',
            'location' => 'Ginko SAE',
            'content' => 'Lorem ipsum',
            'datetime' => '2020-10-10',
            'maxplaces' => 11,
            'availables' => '{}',
            'unavailables' => '[]',
        ]);

        DB::table('blog_posts')->insert([
            'blog' => 'session-a-ginko',
            'title' => 'Session à Ginko',
            'location' => 'Ginko SAE',
            'content' => 'Lorem ipsum',
            'datetime' => '2020-10-17',
            'maxplaces' => 13,
            'availables' => '{}',
            'unavailables' => '[]',
        ]);

        DB::table('blog_posts')->insert([
            'blog' => 'stage-escalade',
            'title' => 'Stage falaise',
            'location' => 'Fontainebleau',
            'content' => 'Lorem ipsum',
            'datetime' => '2020-10-13',
            'maxplaces' => 19,
            'availables' => '{}',
            'unavailables' => '[]',
        ]);
    }
}
