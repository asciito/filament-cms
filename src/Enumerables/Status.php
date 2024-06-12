<?php

namespace Asciito\FilamentCms\Enumerables;

enum Status: string
{
    case DRAFT = 'draft';

    case PUBLISHED = 'published';

    case ARCHIVED = 'archived';

    public static function getTypes(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function forSelect(): array
    {
        return collect(self::cases())
            ->mapWithKeys(function (Status $option) {
                $name = $option->name;
                $value = $option->value;

                return [$value => $name];
            })
            ->toArray();
    }
}
