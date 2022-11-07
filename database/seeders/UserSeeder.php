<?php

namespace Database\Seeders;

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
    public function run()
    {
        DB::table('users')->insert([
            'uuid' => '91554725-10c9-4f8c-8879-80ed83920659',
            'level' => 1,
            'name' => 'Jean Bonnet',
            'img' => '/assets/profiles/user.png',
            'email' => 'utilisateur@email.com',
            'password' => Hash::make('password'),
            'bio' => 'lorem ipsum dolor sit amet',
            'max_bloc' => '6c',
        ]);
    }
}
