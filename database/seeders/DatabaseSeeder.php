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
        User::factory(1)->isAdmin()->create(['email' => 'admin@hotei.com']);
        User::factory(1)->isUser()->create(['email' => 'user@hotei.com']);

        $craftmans = Craftman::factory()->count(6)->create();

        foreach ($craftmans as $index => $craftman) {
            User::factory()->isCraftman()->create([
                'craftman_id' => $craftman->id,
                'email' => 'craftman'.($index + 1).'@hotei.com',
            ]);
        }

        User::factory(150)->isUser()->create();

        $craftmanships = ['Crochet', 'Coutellerie', 'Maroquinerie', 'Poterie'];
        Craftsmanship::factory(count($craftmanships))
            ->state(new Sequence(fn (Sequence $sequence) => ['name' => $craftmanships[$sequence->index]]))
            ->create();

        Project::factory()->count(150)
            ->sequence(fn ($seq) => [
                'craftman_id' => $craftmans->random()->id,
                'craftsmanship_id' => Craftsmanship::all()->random()->id,
            ])
            ->hasCourses(5, function (array $attributes, Project $project) {
                return [
                    'craftman_id' => $project->craftman_id,
                    'craftsmanship_id' => $project->craftsmanship_id,
                ];
            })
            ->create();

        Course::factory()->count(150)->isSkill()->create();
    }
}
