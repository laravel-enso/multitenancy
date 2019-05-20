<?php

namespace LaravelEnso\Multitenancy\app\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\Multitenancy\app\Services\Tenant;
use LaravelEnso\Multitenancy\app\Enums\Connections;

class DropTablesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $tenant;

    public function __construct(Company $tenant)
    {
        $this->tenant = $tenant;

        $this->queue = 'light';
    }

    public function handle()
    {
        Tenant::set($this->tenant);

        DB::connection(Connections::Tenant)
            ->getSchemaBuilder()
            ->dropAllTables();
    }
}
