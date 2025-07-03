<?php

namespace GearboxSolutions\MailLog\Tests;

use GearboxSolutions\MailLog\Providers\MailLogServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    use RefreshDatabase;

    protected function getPackageProviders($app)
    {
        return [
            MailLogServiceProvider::class,
        ];
    }

    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    protected function getEnvironmentSetUp($app)
    {
        // Set up database configuration for testing
        config()->set('database.default', 'testing');
        config()->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    protected function resolveApplicationConsoleKernel($app)
    {
        if (Str::startsWith($app->version(), '10.')) {
            $app->singleton(
                \Illuminate\Contracts\Console\Kernel::class, 'Workbench\App\Console\Kernel'
            );
        }
    }
}
