<?php

namespace Database\Factories;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'role' => fake()->randomElement(UserRole::class),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ?? Hash::make('password'),
            'remember_token' => Str::random(10),
            'credits' => fake()->numberBetween(0, 500),
            'subscription_plan' => null,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Make a new user with the role "user"
     */
    public function isUser(): Factory
    {
        return $this->state(fn () => ['role' => 'user']);
    }

    /**
     * Make a new user with the role "craftman"
     */
    public function isCraftman(): Factory
    {
        return $this->state(fn () => ['role' => 'craftman'])->hasCraftman(1);
    }

    /**
     * Make a new user with the role "user"
     */
    public function isAdmin(): Factory
    {
        return $this->state(fn () => ['role' => 'admin']);
    }
}
