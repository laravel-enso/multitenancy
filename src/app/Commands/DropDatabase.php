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
        if ($this->option->argument('tenantId') === '*') {
            Company::tenants()->get()
                ->each(function ($company) {
                    DropDatabaseJob::dispatch($company);
                });

            return;
        }

        $company = Company::find($this->option->argument('tenantId'));

        if ($company) {
            DropDatabaseJob::dispatch($company);

            return;
        }

        $this->error('The provided argument ":argument" is not valid', [
            'argument' => $this->option->argument('tenantId')
        ]);
    }
}
