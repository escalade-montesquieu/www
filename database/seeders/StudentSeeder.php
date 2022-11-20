<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::factory()->create([
            'name' => 'Test User'
        ]);

        Student::factory()->count(10)->create();

        Student::factory()->count(40)->hasUser()->create();

    }
}
