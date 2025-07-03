<?php

namespace GearboxSolutions\MailLog\Providers;

use GearboxSolutions\MailLog\Commands\DeleteAllMailLogsCommand;
use GearboxSolutions\MailLog\Commands\DeleteOldMailLogsCommand;
use GearboxSolutions\MailLog\Listeners\LogOutgoingMailListener;
use GearboxSolutions\MailLog\Listeners\UpdateEmailStatus;
use Illuminate\Mail\Events\MessageSending;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class MailLogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        // merge configs
        if (!app()->configurationIsCached()) {
            $this->mergeConfigFrom(
                __DIR__ . '/../../config/mail-log.php', 'mail-log'
            );
        }

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'mail-log');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');

        // Fix for Laravel 10+ where publishesMigrations is not available
        if (method_exists($this, 'publishesMigrations')) {
            $this->publishesMigrations([
                __DIR__ . '/../../database/migrations' => database_path('migrations'),
            ], 'mail-log-migrations');
        } else {
            $this->publishes([
                __DIR__ . '/../../database/migrations' => database_path('migrations'),
            ], 'mail-log-migrations');
        }
        
        $this->publishes([
            __DIR__ . '/../../config/mail-log.php' => config_path('mail-log.php'),
        ], 'mail-log-config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                DeleteAllMailLogsCommand::class,
                DeleteOldMailLogsCommand::class,
            ]);
        }

        // Register event listeners
        Event::listen(MessageSending::class, LogOutgoingMailListener::class);
        Event::listen(MessageSent::class, UpdateEmailStatus::class);
    }
}
