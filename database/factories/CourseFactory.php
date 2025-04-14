<?php

namespace Database\Factories;

use App\Models\Craftman;
use App\Models\Craftsmanship;
use App\Enums\Difficulty;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    protected static ?string $craftman_id;
    protected static ?string $craftsmanship_id;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'craftman_id' => self::$craftman_id ?? Craftman::first()?->id ?? Craftman::factory(1)->create()->id,
            'craftsmanship_id' => self::$craftsmanship_id ?? Craftsmanship::first()?->id ?? Craftsmanship::factory(1)->create()->id,
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'duration' => fake()->numberBetween(5, 60),
            'difficulty' =>  fake()->randomElement(Difficulty::class),
            'cost' => fake()->numberBetween(0, 200),
            'materials' => [],
            'is_draft' => fake()->boolean(),
            'is_skill' => false,
        ];
    }

    /**
     * Transform this course into a skill
     */
    public function isSkill(): Factory
    {
        return $this->state(fn () => [ 'is_skill' => true ]);
    }

    /**
     * Make this course draft
     */
    public function isDraft(): Factory
    {
        return $this->state(fn () => [ 'is_draft' => true ]);
    }

    /**
     * Make this course published
     */
    public function isPublished(): Factory
    {
        return $this->state(fn () => [ 'is_draft' => false ]);
    }
}
