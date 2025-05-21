<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        for ($i = 1; $i <= 100; $i++) {
            User::create([
                'name' => 'Test User',
                'email' => 'test' . Str::random(5) . '@example.com',
                'password' => bcrypt(Str::random(5))
            ]);
        }
    }
}
