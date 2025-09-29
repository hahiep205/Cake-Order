<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {

        /*
        *** Tạo account mới, seed lên table users ở database.
        */
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('1'),
            'role' => 'admin',
        ]);

        DB::table('users')->insert([
            'name' => 'Member',
            'email' => 'member@email.com',
            'password' => Hash::make('1'),
            'role' => 'user',
        ]);
    }
}
