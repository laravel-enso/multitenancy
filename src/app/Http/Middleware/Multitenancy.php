<?php

namespace LaravelEnso\Multitenancy\app\Http\Middleware;

use Closure;
use LaravelEnso\Multitenancy\app\Classes\Tenant;

class Multitenancy
{
    public function handle($request, Closure $next)
    {
        $company = optional($request->user())->company();

        if (optional($company)->isTenant()) {
            Tenant::set($company);
        }

        return $next($request);
    }
}
