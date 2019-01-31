<?php

namespace LaravelEnso\Multitenancy;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->app['router']->middleware('multitenancy', Multitinancy::class);
    }

    public function register()
    {
        //
    }
}
