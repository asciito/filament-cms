<?php

use Asciito\FilamentCms\Models\Contracts\ContentType;
use Asciito\FilamentCms\Models\Page;
use Asciito\FilamentCms\Models\Post;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

test('post content-able', function () {
    Post::factory()->create();

    assertDatabaseCount('contents', 1);
    assertDatabaseHas('contents', ['type' => 'post']);
});

test('page content-able', function () {
    Page::factory()->create();

    assertDatabaseCount('contents', 1);
    assertDatabaseHas('contents', ['type' => 'page']);
});
