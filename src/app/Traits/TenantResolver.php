<?php

namespace LaravelEnso\Multitenancy\app\Traits;

trait TenantResolver
{
    public function tenantTable(string $table)
    {
        return $this->tenantDatabase().'.'.$table;
    }

    public function tenantDatabase()
    {
        return \DB::connection('tenant')
            ->getDatabaseName();
    }
}
