<?php

namespace Asciito\FilamentCms;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider as ServiceProvider;

class FilamentCmsServiceProvider extends ServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-cms')
            ->hasMigrations(['2024_06_11_175619_create_contents_table'])
            ->runsMigrations();
    }
}
