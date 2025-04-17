<?php

namespace LaravelEnso\Multitenancy\Traits;

use LaravelEnso\Multitenancy\Enums\Connection;

trait TenantConnection
{
    public function __construct()
    {
        parent::__construct(...func_get_args());

        $this->connection = app()->environment('testing')
            ? Connection::Testing->value
            : Connection::Tenant->value;
    }
}
