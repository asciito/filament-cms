<?php

namespace Asciito\FilamentCms\Database\Factories;

use Asciito\FilamentCms\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @template TModel of Post
 *
 * @extends Factory<TModel>
 */
class PostFactory extends ContentFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<TModel>
     */
    protected $model = Post::class;
}
