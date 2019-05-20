<?php

namespace LaravelEnso\Multitenancy\app\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\Multitenancy\app\Services\Tenant;
use LaravelEnso\Multitenancy\app\Enums\Connections;

class Migrate extends Command
{
    protected $signature = 'enso:tenant:migrate';

    protected $description = 'Performs tenant migrations';

    public function handle()
    {
        Company::tenants()->get()
            ->each(function ($company) {
                Tenant::set($company);

                Artisan::call('migrate', [
                    '--database' => Connections::Tenant,
                    '--path' => '/database/migrations/tenant',
                    '--force' => true,
                ]);
            });
    }
}
