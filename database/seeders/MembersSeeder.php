<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([
            'name' => 'Arthaud Proust',
            'class'=> 'T°9'
        ]);

        DB::table('members')->insert([
            'name' => 'Guilhem Granier',
            'class'=> 'T°9'
        ]);

        DB::table('members')->insert([
            'name' => 'Test Man',
            'class'=> 'T°9'
        ]);
    }
}
