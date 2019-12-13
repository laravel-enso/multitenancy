<?php

namespace LaravelEnso\Multitenancy\app\Enums;

use LaravelEnso\Enums\app\Services\Enum;

class Connections extends Enum
{
    public const System = 'system';
    public const Tenant = 'tenant';
    public const Mixed = 'mixed';
    public const Testing = 'sqlite';
}
