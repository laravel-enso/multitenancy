<?php

namespace LaravelEnso\Multitenancy\app\Traits;

use Illuminate\Support\Facades\DB;
use LaravelEnso\Multitenancy\app\Enums\Connections;

trait TenantResolver
{
    public function tenantTable(string $table)
    {
        return $this->tenantDatabase().'.'.$table;
    }

    public function tenantDatabase()
    {
        return DB::connection(Connections::Tenant)
            ->getDatabaseName();
    }
}
