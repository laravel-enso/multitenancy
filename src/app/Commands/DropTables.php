<?php

namespace LaravelEnso\Multitenancy\App\Commands;

use LaravelEnso\Companies\App\Models\Company;
use LaravelEnso\Multitenancy\App\Jobs\DropTables as Job;

class DropTables extends Tenant
{
    protected $signature = 'enso:tenant:drop-tables {--all=false} {--tenantId}';

    protected $description = 'Drops all tables from tenant database(s)';

    public function dispatch(Company $company): void
    {
        $this->line(__('Dropping tables for company :company', ['company' => $company->name]));

        Job::dispatch($company);
    }
}
