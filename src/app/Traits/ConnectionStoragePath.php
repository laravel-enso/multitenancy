<?php

namespace LaravelEnso\Multitenancy\App\Traits;

use LaravelEnso\Multitenancy\App\Services\Tenant;

trait ConnectionStoragePath
{
    public function storagePath($folder)
    {
        return $this->hasTenantConnection()
            ? config('enso.files.paths.'.$folder)
            : $this->tenantPath().DIRECTORY_SEPARATOR
                .config('enso.files.paths.'.$folder);
    }

    public function tenantPath()
    {
        return config('enso.files.paths.tenants')
            .DIRECTORY_SEPARATOR
            .Tenant::tenantDatabase();
    }
}
