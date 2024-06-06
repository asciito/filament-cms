<?php

namespace Workbench\Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Workbench\App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @template TModel of User
 *
 * @extends Factory<TModel>
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<TModel>
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'email' => fake()->unique()->safeEmail,
            'password' => Hash::make('password'),
            'email_verified_at' => null,
            'remember_token' => Str::random(10),
        ];
    }

    public function verified(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => now(),
            ];
        });
    }
}
