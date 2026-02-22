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
                "user_name" => "user@example.com",
                "password" => bcrypt('password'),
                'created_at' => date('Y-m-d H:i:s'),

            ]
        ]);
    }
}
