<?php

namespace LaravelEnso\Multitenancy\App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use LaravelEnso\Companies\App\Models\Company;
use LaravelEnso\Multitenancy\App\Services\Tenant;
use LaravelEnso\Multitenancy\App\Traits\TenantResolver;

class DropDatabase implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, TenantResolver;

    private $tenant;

    public function __construct(Company $tenant)
    {
        $this->tenant = $tenant;

        $this->queue = 'light';
    }

    public function handle()
    {
        Tenant::set($this->tenant);

        DB::statement('DROP DATABASE '.$this->tenantDatabase());
    }
}
