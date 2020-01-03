<?php

namespace LaravelEnso\Multitenancy\App\Commands;

use LaravelEnso\Companies\App\Models\Company;
use LaravelEnso\Multitenancy\App\Jobs\ClearStorage as Job;

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
