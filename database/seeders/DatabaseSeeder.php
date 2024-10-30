<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $this->call(RoleTableSeeder::class);

        User::factory()->create([
            'name' => 'Nemanja Savic',
            'email' => 'nemanja@gmail.com',
            'password' => Hash::make('nemanja13'),
            'role_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
