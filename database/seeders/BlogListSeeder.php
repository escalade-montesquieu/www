<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blog_list')->insert([
            'is_regular' => true,
            'name' => 'Session au lycée',
            'slug' => 'session-au-lycee',
            'description' => 'Toutes les sessions au lycée'
        ]);

        DB::table('blog_list')->insert([
            'is_regular' => true,
            'name' => 'Session à Ginko',
            'slug' => 'session-a-ginko',
            'description' => 'Toutes les sessions à la salle d\'escalade Ginko'
        ]);

        DB::table('blog_list')->insert([
            'is_regular' => false,
            'name' => 'Sortie falaise',
            'slug' => 'sortie-falaise',
            'description' => 'Parfois nous proposons une sortie en falaise, voici la liste de celles-ci.'
        ]);

        DB::table('blog_list')->insert([
            'is_regular' => false,
            'name' => 'Stage d\'escalade',
            'slug' => 'stage-escalade',
            'description' => 'À chaque fin d\'année, nous organisons un petit (ou grand) stage d\'escalade de quelques jours.'
        ]);
    }
}
