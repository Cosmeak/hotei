<?php

namespace Database\Seeders;

use App\Models\Craftman;
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
        User::factory()->create([
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'admin@hotei.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'firstname' => 'User',
            'lastname' => 'User',
            'email' => 'user@hotei.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        $craftmanUser = User::factory()->create([
            'firstname' => 'Craftman',
            'lastname' => 'Craftman',
            'email' => 'craftman@hotei.com',
            'password' => Hash::make('password'),
            'role' => 'craftman',
        ]);

        $craftman = Craftman::create([
            'user_id' => $craftmanUser->id,
            'avatar' => 'dzada',
            'description' => 'description',
            'categories' => ['test', 'test2'],
        ]);

        $craftman->craftman_id = $craftman->id;
        $craftman->save();
    }
}
