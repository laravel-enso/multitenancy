<?php

namespace LaravelEnso\Multitenancy\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use LaravelEnso\Companies\Models\Company;
use LaravelEnso\Multitenancy\Services\Tenant;
use LaravelEnso\Multitenancy\Traits\ConnectionStoragePath;

class ClearStorage implements ShouldQueue
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
