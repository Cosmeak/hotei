<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Craftman;
use App\Models\Craftsmanship;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1)->isAdmin()->create([ 'email' => 'admin@hotei.com' ]);
        User::factory(1)->isUser()->create([ 'email' => 'user@hotei.com' ]);
        User::factory(1)->isCraftman()->create([ 'email' => 'craftman@hotei.com' ])->each(function (User $user) {
            $user->craftman_id = Craftman::where('user_id', $user->id)->first()->id;
            $user->save();
        });

        User::factory(5)->isCraftman()->create()->each(function (User $user) {
            $user->craftman_id = Craftman::where('user_id', $user->id)->first()->id;
            $user->save();
        });
        User::factory(5)->isUser()->create();

        $craftmanships = ['Crochet', 'Coutellerie', 'Maroquinerie', 'Poterie'];
        Craftsmanship::factory(count($craftmanships))->state(new Sequence(fn (Sequence $sequence) => ['name' => $craftmanships[$sequence->index]]))->create();

        $craftman = Craftman::create([
            'user_id' => $craftmanUser->id,
            'avatar' => 'https://thispersondoesnotexist.com/',
            'description' => 'Passionnée de crochet depuis plusieurs années, Marie Dupont crée des pièces uniques allant des accessoires de mode aux objets décoratifs. Dotée d’un grand souci du détail et d’une créativité sans limite, elle maîtrise diverses techniques comme le crochet tunisien et l’amigurumi. Elle partage son savoir-faire à travers des tutoriels et des créations personnalisées.',
            'categories' => ['test', 'test2'],
        ]);

        $craftmanUser->craftman_id = $craftman->id;
        $craftmanUser->save();

        $craftsmanship = Craftsmanship::create([
            'name' => 'test',
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
