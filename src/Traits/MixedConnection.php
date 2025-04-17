<?php

namespace LaravelEnso\Multitenancy\Traits;

use LaravelEnso\Multitenancy\Enums\Connection;

trait MixedConnection
{
    public function __construct()
    {
        parent::__construct(...func_get_args());

        if (app()->environment('testing')) {
            $this->connection = Connection::Testing->value;

            return;
        }

        $this->connection = empty(config('database.connections.' . Connection::Mixed->value))
            ? Connection::System->value
            : Connection::Mixed->value;
    }

    public function hasTenantConnection()
    {
        return $this->getConnection()->getName() === Connection::Tenant->value;
    }

    public function hasSystemConnection()
    {
        return $this->getConnection()->getName() === Connection::System->value;
    }
}
