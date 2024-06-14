<?php

namespace Asciito\FilamentCms;

use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider as ServiceProvider;

class FilamentCmsServiceProvider extends ServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-cms')
            ->hasViews('filament-cms')
            ->hasMigrations(['2024_06_11_175619_create_contents_table'])
            ->runsMigrations();
    }

    public function packageBooted(): void
    {
        FilamentAsset::register([
            Js::make('plugin', __DIR__.'/../resources/dist/plugin.js')->loadedOnRequest(),
        ], 'asciito/filament-cms');
    }
}
