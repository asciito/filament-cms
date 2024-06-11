<?php

namespace Asciito\FilamentCms\Models\Enumerables;

enum Status: string
{
    case DRAFT = 'draft';

    case PUBLISHED = 'published';

    case ARCHIVED = 'archived';

    public static function getTypes(): array
    {
        return array_column(self::cases(), 'value');
    }
}
