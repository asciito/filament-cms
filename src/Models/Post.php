<?php

namespace Asciito\FilamentCms\Models;

use Asciito\FilamentCms\Database\Factories\PostFactory;
use Asciito\FilamentCms\Models\Concerns\WithContentType;
use Asciito\FilamentCms\Models\Contracts\ContentType;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Content implements ContentType
{
    use HasFactory;
    use WithContentType;

    protected static function newFactory(): PostFactory
    {
        return new PostFactory;
    }
}
