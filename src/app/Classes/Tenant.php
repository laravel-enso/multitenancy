<?php

namespace LaravelEnso\Multitenancy\app\Classes;

use Illuminate\Support\Str;
use LaravelEnso\Companies\app\Models\Company;

class Tenant
{
    public static function set(Company $company)
    {
        $tenantPrefix = config('database.connections.tenant.database');

        config([
            'database.connections.tenant.database' => $tenantPrefix.$company->id
        ]);

        DB::purge('tenant');

        DB::reconnect('tenant');
    }

    public static function get()
    {
        return Company::find(self::tenantId());
    }

    private static function tenantId()
    {
        return (int) Str::replaceFirst(
            'tenant', '', config('database.connections.tenant.database')
        );
    }
}
