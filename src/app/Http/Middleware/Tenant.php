<?php

namespace LaravelEnso\Multitenancy\app\Http\Middleware;

use Closure;
use LaravelEnso\Multitenancy\app\Models\ActionLog;

class Tenant
{
    public function handle($request, Closure $next)
    {
        $company = $request->user()->company();

        if (optional($company)->isTenant()) {
            config(['database.connections.tenant.database' => 'tenant'.$company->id]);

            DB::purge('tenant');

            DB::reconnect('tenant');
        }

        return $next($request);
    }
}
