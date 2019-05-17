<?php

namespace LaravelEnso\Multitenancy\app\Traits;

use LaravelEnso\Multitenancy\app\Classes\Tenant;

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
