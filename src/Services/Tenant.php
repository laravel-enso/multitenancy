<?php

namespace LaravelEnso\Multitenancy\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use LaravelEnso\Companies\Models\Company;
use LaravelEnso\Multitenancy\Enums\Connection;

class Tenant
{
    private static $tenantPrefix;

    public static function set(Company $company)
    {
        $key = 'database.connections.' . Connection::Tenant->value . '.database';
        $value = self::tenantPrefix() . $company->id;
        config([$key => $value]);

        DB::purge(Connection::Tenant->value);

        DB::reconnect(Connection::Tenant->value);
    }

    public static function get()
    {
        return Company::find(self::tenantId());
    }

    public static function tenantDatabase()
    {
        return config('database.connections.' . Connection::Tenant->value . '.database');
    }

    private static function tenantId()
    {
        return (int) Str::replaceFirst(Connection::Tenant->value, '', self::tenantDatabase());
    }

    private static function tenantPrefix()
    {
        if (!isset(self::$tenantPrefix)) {
            self::$tenantPrefix = self::tenantDatabase();
        }

        return self::$tenantPrefix;
    }
}
