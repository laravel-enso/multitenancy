<?php

namespace LaravelEnso\Multitenancy\app\Traits;

trait SystemResolver
{
    public function systemTable(string $table)
    {
        return $this->systemDatabase().'.'.$table;
    }

    public function systemDatabase()
    {
        return \DB::connection('system')
            ->getDatabaseName();
    }
}
