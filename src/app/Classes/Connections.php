<?php

namespace LaravelEnso\Multitenancy\app\Classes;

use LaravelEnso\Helpers\app\Classes\Enum;

class Connections extends Enum
{
    const System = 'system';
    const Tenant = 'tenant';
    const Mixed = 'mixed';
    const Testing = 'sqlite';
}
