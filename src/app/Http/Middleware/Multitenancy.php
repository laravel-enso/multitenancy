<?php

namespace LaravelEnso\Multitenancy\app\Http\Middleware;

use Closure;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\Multitenancy\app\Services\Tenant;
use LaravelEnso\Multitenancy\app\Services\MixedConnection;

class Multitenancy
{
    public function handle($request, Closure $next)
    {
        if (! $request->user()) {
            return $next($request);
        }

        $company = $this->ownerRequestsTenant($request)
            ? Company::find($request->get('_tenantId'))
            : $request->user()->company();

        if (optional($company)->isTenant()) {
            Tenant::set($company);
        }

        MixedConnection::set(
            $request->user(), $request->has('_tenantId')
        );

        if ($request->has('_tenantId')) {
            $request->request->remove('_tenantId');
        }

        return $next($request);
    }

    private function ownerRequestsTenant($request)
    {
        return $request->user()->belongsToAdminGroup()
            && $request->has('_tenantId');
    }
}
