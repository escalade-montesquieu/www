<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
    }
}
