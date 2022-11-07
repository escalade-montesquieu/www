<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use BlogListSeeder;
use ForumListSeeder;
use Illuminate\Database\Seeder;
use MembersSeeder;
use PostsSeeder;
use UserSeeder;

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
        $this->call(ForumListSeeder::class);
        $this->call(BlogListSeeder::class);
        // $this->call(MessagesSeeder::class);
        $this->call(PostsSeeder::class);
        $this->call(MembersSeeder::class);
    }
}
