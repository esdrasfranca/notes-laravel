<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user')->insert([
            [
            "user_name" => "jose@email.com",
            "password" => bcrypt('123456'),
            'created_at' => date('Y-m-d H:i:s'),

           ],[
            "user_name" => "jose2@email.com",
            "password" => bcrypt('123456'),
            'created_at' => date('Y-m-d H:i:s'),

           ],[
            "user_name" => "jose3@email.com",
            "password" => bcrypt('123456'),
            'created_at' => date('Y-m-d H:i:s'),
           ]
        ]);
    }
}
