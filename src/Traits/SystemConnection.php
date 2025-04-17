<?php

namespace LaravelEnso\Multitenancy\Traits;

use LaravelEnso\Multitenancy\Enums\Connection;

trait SystemConnection
{
    public function __construct()
    {
        parent::__construct(...func_get_args());

        $this->connection = app()->environment('testing')
            ? Connection::Testing->value
            : Connection::System->value;
    }
}
