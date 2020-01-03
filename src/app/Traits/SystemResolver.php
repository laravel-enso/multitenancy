<?php

namespace LaravelEnso\Multitenancy\App\Traits;

use Illuminate\Support\Facades\DB;
use LaravelEnso\Multitenancy\App\Enums\Connections;

trait SystemResolver
{
    public function systemTable(string $table)
    {
        return $this->systemDatabase().'.'.$table;
    }

    public function systemDatabase()
    {
        return DB::connection(Connections::System)
            ->getDatabaseName();
    }
}
