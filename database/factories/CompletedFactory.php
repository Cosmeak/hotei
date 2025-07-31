<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Completed>
 */
class CompletedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'user_id' => User::inRandomOrder()->value('id'),
            'course_id' => null,
            'completed_at' => now(),
        ];
    }

    public function forCourse(): static
    {
        return $this->state(function () {
            return [
                'course_id' => Course::inRandomOrder()->value('id'),
            ];
        });
    }
}
