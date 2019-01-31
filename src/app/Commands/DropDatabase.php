<?php

namespace LaravelEnso\Multitenancy\app\Commands;

use Illuminate\Console\Command;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\Multitenancy\app\Jobs\DropDatabaseJob;
use LaravelEnso\Multitenancy\app\Traits\TenantResolver;

class DropDatabase extends Command
{
    use TenantResolver;

    protected $signature = 'enso:tenant:drop-database {tenantId?}';

    protected $description = 'Drops tenant database(s)';

    public function handle()
    {
        if ($this->argument('tenantId') === 'all') {
            Company::tenants()->get()
                ->each(function ($company) {
                    DropDatabaseJob::dispatch($company);
                });

            return;
        }

        $company = Company::find($this->argument('tenantId'));

        if ($company) {
            DropDatabaseJob::dispatch($company);

            return;
        }

        $this->error('The provided argument is not valid');
    }
}
