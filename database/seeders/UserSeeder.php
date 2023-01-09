<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory()->create([
            'email' => 'student@email.com',
            'name' => 'Stu Dent',
        ]);

        User::factory()->moderator()->create([
            'email' => 'moderator@email.com',
            'name' => 'Modé Rator',
        ]);

        User::factory()->admin()->create([
            'email' => 'admin@email.com',
            'name' => 'Adé Min',
        ]);

        User::factory()->create([
            'email' => 'arthaudp33+dev-escalade-montesquieu@gmail.com',
            'name' => 'Arthaud Proust',
        ]);
    }
}
