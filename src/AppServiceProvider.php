<?php

namespace LaravelEnso\Multitenancy;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\Multitenancy\App\Commands\ClearStorage;
use LaravelEnso\Multitenancy\App\Commands\CreateDatabase;
use LaravelEnso\Multitenancy\App\Commands\DropDatabase;
use LaravelEnso\Multitenancy\App\Commands\DropTables;
use LaravelEnso\Multitenancy\App\Commands\Migrate;
use LaravelEnso\Multitenancy\App\Http\Middleware\Multitenancy;

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
