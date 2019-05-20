<?php

namespace LaravelEnso\Multitenancy\app\Traits;

use LaravelEnso\Multitenancy\app\Enums\Connections;

trait SystemConnection
{
    public function __construct()
    {
        parent::__construct(...func_get_args());

        $this->connection = app()->environment('testing')
            ? Connections::Testing
            : Connections::System;
    }
}
