<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Craftman;
use App\Models\Craftsmanship;
use App\Models\Project;
use App\Models\User;
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
            'firstname' => 'Marie',
            'lastname' => 'Dupont',
            'email' => 'craftman@hotei.com',
            'password' => Hash::make('password'),
            'role' => 'craftman',
        ]);

        $craftman = Craftman::create([
            'user_id' => $craftmanUser->id,
            'avatar' => 'https://thispersondoesnotexist.com/',
            'description' => 'Passionnée de crochet depuis plusieurs années, Marie Dupont crée des pièces uniques allant des accessoires de mode aux objets décoratifs. Dotée d’un grand souci du détail et d’une créativité sans limite, elle maîtrise diverses techniques comme le crochet tunisien et l’amigurumi. Elle partage son savoir-faire à travers des tutoriels et des créations personnalisées.',
            'categories' => ['test', 'test2'],
        ]);

        $craftmanUser->craftman_id = $craftman->id;
        $craftmanUser->save();

        $craftsmanship = Craftsmanship::create([
            'name' => 'Crochet',
            'color' => '#ffffff',
            'description' => 'dzadza dza dza dzad za',
        ]);

        Craftsmanship::create([
            'name' => 'Coutellerie',
            'color' => '#ffffff',
            'description' => 'dzadza dza dza dzad za',
        ]);

        Craftsmanship::create([
            'name' => 'Maroquinerie',
            'color' => '#ffffff',
            'description' => 'dzadza dza dza dzad za',
        ]);

        Craftsmanship::create([
            'name' => 'Poterie',
            'color' => '#ffffff',
            'description' => 'dzadza dza dza dzad za',
        ]);

        $course = Course::create([
            'craftman_id' => $craftman->id,
            'craftsmanship_id' => $craftsmanship->id,
            'title' => 'Faire une chainette',
            'duration' => '50',
            'description' => '',
            'difficulty' => '2',
            'cost' => '50',
            'materials' => ['Un crochet adapté', 'Une pelote de fil'],
            'is_draft' => false,
            'is_skill' => true,
        ]);

        $project = Project::create([
            'craftman_id' => $craftman->id,
            'craftsmanship_id' => $craftsmanship->id,
            'description' => "La chaînette est la base de presque tous les projets au crochet. Elle consiste à créer une série de mailles en l'air qui serviront de fondation pour le reste de l'ouvrage.",
            'duration' => '50',
            'is_draft' => false,
        ]);

        $project->courses()->attach($course->id);
    }
}
