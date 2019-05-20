<?php

namespace LaravelEnso\Multitenancy\app\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\Multitenancy\app\Services\Tenant;
use LaravelEnso\Multitenancy\app\Traits\ConnectionStoragePath;

class ClearStorageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, ConnectionStoragePath;

    private $tenant;

    public function __construct(Company $tenant)
    {
        $this->tenant = $tenant;

        $this->queue = 'light';
    }

    public function handle()
    {
        Tenant::set($this->tenant);

        Storage::deleteDirectory($this->tenantPath());
    }
}
