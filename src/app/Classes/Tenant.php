<?php

namespace LaravelEnso\Multitenancy\app\Classes;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use LaravelEnso\Companies\app\Models\Company;

class Tenant
{
    private static $tenantPrefix;

    public static function set(Company $company)
    {
        config([
            'database.connections.tenant.database' => self::tenantPrefix().$company->id,
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
            'tenant',
            '',
            self::tenantDatabase()
        );
    }

    private static function tenantDatabase()
    {
        return config('database.connections.tenant.database');
    }

    private static function tenantPrefix()
    {
        if (! isset(self::$tenantPrefix)) {
            self::$tenantPrefix = self::tenantDatabase();
        }

        return self::$tenantPrefix;
    }
}
