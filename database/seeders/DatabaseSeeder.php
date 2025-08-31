<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'username'   => 'testuser',
            'password'   => bcrypt('password'), // or Hash::make('password')
            'first_name' => 'Test',
            'last_name'  => 'User',
            'role_id'    => 1, // e.g. Admin role
            'status'     => 'active',
        ]);
    }
}
