<?php

namespace LaravelEnso\Multitenancy\Commands;

use LaravelEnso\Companies\Models\Company;
use LaravelEnso\Multitenancy\Jobs\ClearStorage as Job;

class ClearStorage extends Tenant
{
    protected $signature = 'enso:tenant:clear-storage {--all=false} {--tenantId}';

    protected $description = 'Clears tenant storage';

    public function dispatch(Company $company): void
    {
        $this->line(__('Clearing storage for company :company', ['company' => $company->name]));

        Job::dispatch($company);
    }
}
