<?php

namespace LaravelEnso\Multitenancy\App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use LaravelEnso\Companies\App\Models\Company;
use LaravelEnso\Multitenancy\App\Enums\Connections;
use LaravelEnso\Multitenancy\App\Services\Tenant;

class Migrate implements ShouldQueue
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
