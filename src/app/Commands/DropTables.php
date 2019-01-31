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
        $company = Company::find($this->option->argument('tenantId'));

        if ($company) {
            DropTablesJob::dispatch($company);

            return;
        }

        if ($this->option->argument('tenantId') === '*') {
            Company::tenants()->get()
                ->each(function ($company) {
                    DropTablesJob::dispatch($company);
                });

            return;
        }

        $this->error('The provided argument ":argument" is not valid', [
            'argument' => $this->option->argument('tenantId')
        ]);
    }
}
