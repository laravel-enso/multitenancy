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
        $company = Company::find($this->option->argument('tenantId'));

        if ($company) {
            CreateDatabaseJob::dispatch($company);

            return;
        }

        $this->error('The provided argument ":argument" is not valid', [
            'argument' => $this->option->argument('tenantId')
        ]);
    }
}
