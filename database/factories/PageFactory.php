<?php

namespace Asciito\FilamentCms\Database\Factories;

use Asciito\FilamentCms\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @template TModel of Page
 *
 * @extends Factory<TModel>
 */
class PageFactory extends ContentFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<TModel>
     */
    protected $model = Page::class;
}
