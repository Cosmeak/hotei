<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Course;
use App\Models\Order;
use App\Models\Project;
use App\Models\User;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'user_id' => User::inRandomOrder()->value('id'),
            'course_id' => null,
            'project_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function forCourse(): static
    {
        return $this->state(function () {
            return [
                'course_id' => Course::inRandomOrder()->value('id'),
                'project_id' => null,
            ];
        });
    }

    public function forProject(): static
    {
        return $this->state(function () {
            return [
                'project_id' => Project::inRandomOrder()->value('id'),
                'course_id' => null,
            ];
        });
    }
}
