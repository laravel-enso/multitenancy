<?php

namespace LaravelEnso\Multitenancy\app\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\Multitenancy\app\Services\Tenant;
use LaravelEnso\Multitenancy\app\Enums\Connections;

class MigrateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $tenant;

    public function __construct(Company $tenant)
    {
        $this->tenant = $tenant;

        $this->queue = 'sync';
    }

    public function handle()
    {
        Tenant::set($this->tenant);

        Artisan::call('migrate', [
            '--database' => Connections::Tenant,
            '--path' => '/database/migrations/tenant',
            '--force' => true,
        ]);
    }
}
