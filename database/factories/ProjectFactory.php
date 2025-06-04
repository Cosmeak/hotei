<?php

namespace Database\Factories;

use App\Models\Craftman;
use App\Models\Craftsmanship;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
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
            'description' => fake()->paragraph(),
            'duration' => fake()->numberBetween(30, 200),
            'is_draft' => false,
        ];
    }

    /**
     * Make this project draft
     */
    public function isDraft(): Factory
    {
        return $this->state(fn () => ['is_draft' => true]);
    }

    /**
     * Make this project published
     */
    public function isPublished(): Factory
    {
        return $this->state(fn () => ['is_draft' => false]);
    }
}
