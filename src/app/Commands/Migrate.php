<?php

namespace LaravelEnso\Multitenancy\app\Commands;

use Illuminate\Console\Command;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\Multitenancy\app\Jobs\MigrateJob;

class Migrate extends Command
{
    protected $signature = 'enso:tenant:migrate';

    protected $description = 'Performs tenant migrations';

    public function handle()
    {
        Company::tenants()->get()
            ->each(function ($company) {
                MigrateJob::dispatch($company);
            });
    }
}
