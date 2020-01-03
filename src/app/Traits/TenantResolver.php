<?php

namespace LaravelEnso\Multitenancy\App\Traits;

use Illuminate\Support\Facades\DB;
use LaravelEnso\Multitenancy\App\Enums\Connections;

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
