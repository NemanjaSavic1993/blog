<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("roles")->insert([
            [
                "name" => 'Administrator',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "name" => 'Moderator',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "name" => 'Bloger',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
