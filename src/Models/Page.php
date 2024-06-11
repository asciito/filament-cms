<?php

namespace Asciito\FilamentCms\Models;

use Asciito\FilamentCms\Database\Factories\PageFactory;
use Asciito\FilamentCms\Models\Concerns\WithContentType;
use Asciito\FilamentCms\Models\Contracts\ContentType;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Content implements ContentType
{
    use HasFactory,
        WithContentType;

    protected static function newFactory(): PageFactory
    {
        return new PageFactory;
    }
}
