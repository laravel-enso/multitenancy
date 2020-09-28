<?php

namespace LaravelEnso\Multitenancy\Enums;

use LaravelEnso\Enums\Services\Enum;

class Connections extends Enum
{
    public const System = 'system';
    public const Tenant = 'tenant';
    public const Mixed = 'mixed';
    public const Testing = 'sqlite';
}
