<?php

namespace LaravelEnso\Multitenancy\app\Commands;

use Illuminate\Console\Command;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\Multitenancy\app\Jobs\DropTablesJob;

class DropTables extends Command
{
    protected $signature = 'enso:tenant:drop-tables {tenantId?}';

    protected $description = 'Drops all tables from tenant database(s)';

    public function handle()
    {
        $company = Company::find($this->argument('tenantId'));

        if ($company) {
            DropTablesJob::dispatch($company);

            return;
        }

        if ($this->argument('tenantId') === 'all') {
            Company::tenants()->get()
                ->each(function ($company) {
                    DropTablesJob::dispatch($company);
                });

            return;
        }

        $this->error('The provided argument is not valid');
    }
}
