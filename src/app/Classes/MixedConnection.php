<?php

namespace LaravelEnso\Multitenancy\app\Classes;

use Illuminate\Support\Facades\DB;

class MixedConnection
{
    public static function set($user, $tenant)
    {
        if (! $user->belongsToAdminGroup() || $tenant) {
            self::connection(Connections::Tenant);
        } else {
            self::connection(Connections::System);
        }

        DB::purge(Connections::Mixed);

        DB::reconnect(Connections::Mixed);
    }

    private static function connection($connection)
    {
        config([
            'database.connections.'.Connections::Mixed => config('database.connections.'.$connection),
        ]);
    }
}
