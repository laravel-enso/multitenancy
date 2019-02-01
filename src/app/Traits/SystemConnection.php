<?php

namespace LaravelEnso\Multitenancy\app\Traits;

trait SystemConnection
{
    public function __construct($attributes = [])
    {
        parent::__construct($attributes);

        $this->connection = app()->environment('testing')
            ? 'sqlite'
            : 'system';
    }
}
