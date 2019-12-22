<?php

namespace LaravelEnso\Multitenancy\app\Commands;

use Illuminate\Console\Command;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\Multitenancy\app\Jobs\CreateDatabaseJob;

class CreateDatabase extends Command
{
    protected $signature = 'enso:tenant:create-database {tenantId}';

    protected $description = 'Creates tenant database';

    public function handle()
    {
        if ($this->argument('tenantId') === 'all') {
            Company::tenants()->get()
                ->each(fn($company) => CreateDatabaseJob::dispatch($company));

            return;
        }

        $company = Company::find($this->argument('tenantId'));

        if ($company) {
            CreateDatabaseJob::dispatch($company);

            return;
        }

        $this->error('The provided argument is not valid');
    }
}
