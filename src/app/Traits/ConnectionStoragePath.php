<?php

namespace LaravelEnso\Multitenancy\app\Traits;

use LaravelEnso\Multitenancy\app\Classes\Tenant;

trait ConnectionStoragePath
{
    public function storagePath($folder)
    {
        return $this->hasTenantConnection()
            ? config('enso.config.paths.'.$folder)
            : $this->tenantPath().DIRECTORY_SEPARATOR
                .config('enso.config.paths.'.$folder);
    }

    public function tenantPath()
    {
        return config('enso.config.paths.tenants')
            .DIRECTORY_SEPARATOR
            .Tenant::tenantDatabase();
    }
}
