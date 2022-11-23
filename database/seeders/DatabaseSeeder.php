<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(EventCategorySeeder::class);
        $this->call(EventSeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(ForumMessageSeeder::class);
    }
}
