<?php

namespace Asciito\FilamentCms;

use Filament\Contracts\Plugin;
use Filament\Panel;

class FilamentCmsPlugin implements Plugin
{
    public function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static */
        return filament(app(static::class)->getId());
    }

    public function getId(): string
    {
        return 'filament-cms';
    }

    public function register(Panel $panel): void
    {

    }

    public function boot(Panel $panel): void
    {
        // TODO: Implement boot() method.
    }
}
