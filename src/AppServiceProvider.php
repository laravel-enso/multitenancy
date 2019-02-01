<?php

namespace LaravelEnso\Multitenancy;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\Multitenancy\app\Commands\Migrate;
use LaravelEnso\Multitenancy\app\Commands\DropTables;
use LaravelEnso\Multitenancy\app\Commands\DropDatabase;
use LaravelEnso\Multitenancy\app\Commands\CreateDatabase;
use LaravelEnso\Multitenancy\app\Http\Middleware\Multitenancy;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands([
            CreateDatabase::class,
            DropDatabase::class,
            DropTables::class,
            Migrate::class,
        ]);

        $this->app['router']->aliasMiddleware(
            'multitenancy',
            Multitenancy::class
        );
    }

    public function register()
    {
        //
    }
}
