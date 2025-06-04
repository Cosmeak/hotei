<?php

namespace Database\Factories;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Craftman>
 */
class CraftmanFactory extends Factory
{
    protected static ?string $user_id;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => self::$user_id ?? User::where('role', UserRole::Craftman->value)->first()?->id ?? User::factory(1)->create()->id,
            'avatar' => 'https://thispersondoesnotexist.com/',
            'website' => 'https://'.fake()->safeEmailDomain(),
            'phone' => fake()->phoneNumber(),
            'instagram' => fake()->userName(),
            'facebook' => fake()->userName(),
            'categories' => [],
            'description' => fake()->sentence(),
        ];
    }
}
