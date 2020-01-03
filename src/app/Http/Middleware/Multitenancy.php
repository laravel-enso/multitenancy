<?php

namespace LaravelEnso\Multitenancy\App\Http\Middleware;

use Closure;
use LaravelEnso\Companies\App\Models\Company;
use LaravelEnso\Multitenancy\App\Services\MixedConnection;
use LaravelEnso\Multitenancy\App\Services\Tenant;

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
            $request->user(),
            $request->has('_tenantId')
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
