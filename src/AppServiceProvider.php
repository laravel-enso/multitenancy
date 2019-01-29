<?php

namespace LaravelEnso\Multitenancy;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\Multitenancy\app\Http\Middleware\Tenant;
use LaravelEnso\Multitenancy\app\Http\Middleware\ActionLogger;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->app['router']->middleware('tenant', Tenant::class);
    }

    public function register()
    {
        //
    }
}
