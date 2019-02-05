<?php

namespace LaravelEnso\Multitenancy\app\Traits;

use LaravelEnso\Multitenancy\app\Classes\Connections;

trait TenantResolver
{
    public function tenantTable(string $table)
    {
        return $this->tenantDatabase().'.'.$table;
    }

    public function tenantDatabase()
    {
        return \DB::connection(Connections::Tenant)
            ->getDatabaseName();
    }
}
