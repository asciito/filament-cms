<?php

namespace Asciito\FilamentCms\Tests;

use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Workbench\App\Models\User;

abstract class TestCase extends OrchestraTestCase
{
    use WithWorkbench;

    protected User $user;

    protected $enablesPackageDiscoveries = true;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }
}
