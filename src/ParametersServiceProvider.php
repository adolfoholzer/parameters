<?php

declare(strict_types=1);

namespace Zitro\Parameters;

use Illuminate\Support\ServiceProvider;

class ParametersServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/parameters.php', 'parameters');

        $this->app->singleton(Parameters::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__.'/../config/parameters.php' => config_path('parameters.php'),
        ], ['parameters', 'parameters-config']);

        $this->publishesMigrations([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], ['parameters', 'parameters-migrations']);
    }
}
