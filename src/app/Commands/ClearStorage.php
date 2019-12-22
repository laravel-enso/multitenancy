<?php

namespace LaravelEnso\Multitenancy\app\Commands;

use Illuminate\Console\Command;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\Multitenancy\app\Jobs\ClearStorageJob;
use LaravelEnso\Multitenancy\app\Traits\ConnectionStoragePath;

class ClearStorage extends Command
{
    use ConnectionStoragePath;

    protected $signature = 'enso:tenant:clear-storage {tenantId}';

    protected $description = 'Clears tenant storage';

    public function handle()
    {
        if ($this->argument('tenantId') === 'all') {
            Company::tenants()->get()
                ->each(fn($company) => ClearStorageJob::dispatch($company));

            return;
        }

        $company = Company::find($this->argument('tenantId'));

        if ($company) {
            ClearStorageJob::dispatch($company);

            return;
        }

        $this->error('The provided argument is not valid');
    }
}
