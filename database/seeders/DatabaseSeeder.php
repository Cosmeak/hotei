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
        User::factory(1)->isCraftman()->create(['email' => 'craftman@hotei.com'])->each(function (User $user) {
            $user->craftman_id = Craftman::where('user_id', $user->id)->first()->id;
            $user->save();
        });

        User::factory(5)->isCraftman()->create()->each(function (User $user) {
            $user->craftman_id = Craftman::where('user_id', $user->id)->first()->id;
            $user->save();
        });
        User::factory(150)->isUser()->create();

        $craftmanships = ['Crochet', 'Coutellerie', 'Maroquinerie', 'Poterie'];
        Craftsmanship::factory(count($craftmanships))->state(new Sequence(fn (Sequence $sequence) => ['name' => $craftmanships[$sequence->index]]))->create();

        Project::factory()->count(150)->has(Course::factory()->isSkill()->count(3))->create()->each(function ($project) {
            for ($i = 1; $i <= 5; $i++) {
                $course = Course::factory()->create([
                    'craftman_id' => $project->craftman_id,
                    'craftsmanship_id' => $project->craftsmanship_id,
                    'cost' => 0
                ]);

                $project->courses()->attach($course->id, [
                    'position' => $i,
                ]);
            }
        });

        Course::factory()->count(150)->isSkill()->create();
    }
}
