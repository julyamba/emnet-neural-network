<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Project;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::factory()->create([
            'name' => 'Jul Maico Yamba',
            'email' => 'jyamz7690@gmail.com',
            'password' => 'test123456',
            'is_admin' => true
        ]);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password'
        ]);

        Project::factory(10)->create([
        'by_user_id' => 1
        ]);

        Project::factory(10)->create([
        'by_user_id' => 2
        ]);
    }
}
