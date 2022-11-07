<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ForumListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('forum_list')->insert([
            'name' => 'Sessions autonomes',
            'slug' => 'sessions-autonomes',
            'description' => 'Cette discussion est dédiée à l\'organisation de sessions autonomes entre les grimpeurs.'
        ]);

        DB::table('forum_list')->insert([
            'name' => 'Discussion de mouvs, blocs...',
            'slug' => 'mouvs-et-blocs',
            'description' => 'Discutez des mouvement travailler sur un bloc en particulier.'
        ]);

        DB::table('forum_list')->insert([
            'name' => 'Matériel',
            'slug' => 'materiel',
            'description' => 'Vous donnez ou rechercher du matos? C\'est ici que ça se passe.'
        ]);

        DB::table('forum_list')->insert([
            'name' => 'À voir, à lire',
            'slug' => 'a-voir-a-lire',
            'description' => 'Ce sujet regroupe les différentes vidéos, sujet et articles inttéressant pour la grimpe.'
        ]);
    }
}
