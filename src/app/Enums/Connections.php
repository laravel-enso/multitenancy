<?php

namespace LaravelEnso\Multitenancy\app\Enums;

use LaravelEnso\Enums\app\Services\Enum;

class Connections extends Enum
{
    const System = 'system';
    const Tenant = 'tenant';
    const Mixed = 'mixed';
    const Testing = 'sqlite';
}
