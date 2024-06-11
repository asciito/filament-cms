<?php

namespace Asciito\FilamentCms\Database\Factories;

use Asciito\FilamentCms\Models\Enumerables\Status;
use Asciito\FilamentCms\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @template TModel of Page
 *
 * @extends Factory<TModel>
 */
abstract class ContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $title = fake()->text(127),
            'slug' => Str::slug($title),
            'body' => fake()->realText(1027),
            'status' => fake()->randomElement(Status::getTypes()),
        ];
    }
}
