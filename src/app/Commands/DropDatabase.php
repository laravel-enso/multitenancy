<?php

namespace LaravelEnso\Multitenancy\App\Commands;

use LaravelEnso\Companies\App\Models\Company;
use LaravelEnso\Multitenancy\App\Jobs\DropDatabase as Job;

class DropDatabase extends Tenant
{
    protected $signature = 'enso:tenant:drop-database {--all=false} {--tenantId}';

    protected $description = 'Drops tenant database(s)';

    public function dispatch(Company $company): void
    {
        $this->line(__('Dropping database for company :company', ['company' => $company->name]));

        Job::dispatch($company);
    }
}
