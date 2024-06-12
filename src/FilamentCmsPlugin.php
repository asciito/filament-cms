<?php

namespace Asciito\FilamentCms;

use Asciito\FilamentCms\Filament\Resources\PageResource;
use Asciito\FilamentCms\Filament\Resources\PostResource;
use Filament\Contracts\Plugin;
use Filament\Panel;

class FilamentCmsPlugin implements Plugin
{
    public static function make(): static
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
        $panel
            ->resources([
                PostResource::class,
                PageResource::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        // TODO: Implement boot() method.
    }
}
