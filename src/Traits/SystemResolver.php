<?php

namespace LaravelEnso\Multitenancy\Traits;

use Illuminate\Support\Facades\DB;
use LaravelEnso\Multitenancy\Enums\Connection;

trait SystemResolver
{
    public function systemTable(string $table)
    {
        return $this->systemDatabase() . '.' . $table;
    }

    public function systemDatabase()
    {
        return DB::connection(Connection::System->value)
            ->getDatabaseName();
    }
}
