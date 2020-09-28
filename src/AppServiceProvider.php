<?php

namespace LaravelEnso\Multitenancy;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\Multitenancy\Commands\ClearStorage;
use LaravelEnso\Multitenancy\Commands\CreateDatabase;
use LaravelEnso\Multitenancy\Commands\DropDatabase;
use LaravelEnso\Multitenancy\Commands\DropTables;
use LaravelEnso\Multitenancy\Commands\Migrate;
use LaravelEnso\Multitenancy\Http\Middleware\Multitenancy;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands(
            CreateDatabase::class,
            DropDatabase::class,
            ClearStorage::class,
            DropTables::class,
            Migrate::class
        );

        $this->app['router']->aliasMiddleware(
            'multitenancy',
            Multitenancy::class
        );
    }
}
