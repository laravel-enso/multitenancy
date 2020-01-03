<?php

namespace LaravelEnso\Multitenancy\App\Enums;

use LaravelEnso\Enums\App\Services\Enum;

class Connections extends Enum
{
    public const System = 'system';
    public const Tenant = 'tenant';
    public const Mixed = 'mixed';
    public const Testing = 'sqlite';
}
