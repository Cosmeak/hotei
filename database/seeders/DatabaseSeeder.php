<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Craftman;
use App\Models\Project;
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
        // Create admin and user
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

        // Create craftman user
        $craftmanUser = User::factory()->create([
            'firstname' => 'Craftman',
            'lastname' => 'Craftman',
            'email' => 'craftman@hotei.com',
            'password' => Hash::make('password'),
            'role' => 'craftman',
        ]);

        // Create craftman profile
        $craftman = Craftman::create([
            'user_id' => $craftmanUser->id,
            'avatar' => 'dzada',
            'description' => 'description',
            'categories' => ['test', 'test2'],
        ]);

        $craftmanUser->craftman_id = $craftman->id;
        $craftmanUser->save();

        // Create some courses for the craftman
        Course::create([
            'craftman_id' => $craftman->id,
            'title' => 'zadzf',
            'description' => 'lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet',
            'category' => 'category',
            'duration' => 7,
            'materials' => ['metal', 'wood', 'clay'],
            'is_draft' => false,
            'cost' => 23,
            'difficulty' => 2,
        ]);

        // Create some projects for the craftman
        Project::create([
            'craftman_id' => $craftman->id,
            'title' => 'project | azferzgf',
            'description' => 'lorem ipsum dolor sit amet',
            'difficulty' => 3,
            'is_draft' => false,
            'cost' => 50,
            'category' => 'wood work',
        ]);
    }
}
