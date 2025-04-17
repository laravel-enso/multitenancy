<?php

namespace LaravelEnso\Multitenancy\Traits;

use Illuminate\Support\Facades\DB;
use LaravelEnso\Multitenancy\Enums\Connection;

trait TenantResolver
{
    public function tenantTable(string $table)
    {
        return $this->tenantDatabase() . '.' . $table;
    }

    public function tenantDatabase()
    {
        return DB::connection(Connection::Tenant->value)
            ->getDatabaseName();
    }
}
