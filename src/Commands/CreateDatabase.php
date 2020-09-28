<?php

namespace LaravelEnso\Multitenancy\Commands;

use LaravelEnso\Companies\Models\Company;
use LaravelEnso\Multitenancy\Jobs\CreateDatabase as Job;

class CreateDatabase extends Tenant
{
    protected $signature = 'enso:tenant:create-database {--all=false} {--tenantId}';

    protected $description = 'Creates tenant database';

    public function dispatch(Company $company): void
    {
        $this->line(__('Creating database for company :company', ['company' => $company->name]));

        Job::dispatch($company);
    }
}
