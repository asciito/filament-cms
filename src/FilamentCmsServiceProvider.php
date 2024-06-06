<?php

namespace Asciito\FilamentCms;

use Spatie\LaravelPackageTools\Package;

class FilamentCmsServiceProvider extends \Spatie\LaravelPackageTools\PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-cms')
            ->hasViews('filament-cms');
    }
}
