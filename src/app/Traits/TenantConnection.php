<?php

namespace LaravelEnso\Multitenancy\app\Traits;

trait TenantConnection
{
    public function __construct($attributes = [])
    {
        parent::__construct($attributes);

        $this->connection = config('app.env') === 'testing'
            ? 'sqlite'
            : 'tenant';
    }
}