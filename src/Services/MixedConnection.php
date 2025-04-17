<?php

namespace LaravelEnso\Multitenancy\Services;

use Illuminate\Support\Facades\DB;
use LaravelEnso\Multitenancy\Enums\Connection;

class MixedConnection
{
    public static function set($user, $tenant)
    {
        if (!$user->belongsToAdminGroup() || $tenant) {
            self::connection(Connection::Tenant->value);
        } else {
            self::connection(Connection::System->value);
        }

        DB::purge(Connection::Mixed->value);

        DB::reconnect(Connection::Mixed->value);
    }

    private static function connection($connection)
    {
        $key = 'database.connections.' . Connection::Mixed->value;
        $value = config("database.connections.{$connection}");
        config([$key => $value]);
    }
}
