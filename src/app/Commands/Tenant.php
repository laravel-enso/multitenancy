<?php

namespace LaravelEnso\Multitenancy\App\Commands;

use Illuminate\Console\Command;
use LaravelEnso\Companies\App\Models\Company;
use LaravelEnso\Multitenancy\App\Traits\ConnectionStoragePath;

abstract class Tenant extends Command
{
    use ConnectionStoragePath;

    abstract public function dispatch(Company $company): void;

    public function handle()
    {
        if ($this->option('all')) {
            Company::tenant()->each(fn ($company) => $this->dispatch($company));

            return;
        }

        $company = Company::find($this->option('tenantId'));

        if ($company) {
            $this->dispatch($company);

            return;
        }

        $this->error('Invalid option provided');
    }
}
