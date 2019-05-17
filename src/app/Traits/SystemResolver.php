<?php

namespace LaravelEnso\Multitenancy\app\Traits;

use Illuminate\Support\Facades\DB;
use LaravelEnso\Multitenancy\app\Classes\Connections;

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
