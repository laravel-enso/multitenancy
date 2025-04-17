<?php

namespace LaravelEnso\Multitenancy\Enums;

enum Connection: string
{
    case System = 'system';
    case Tenant = 'tenant';
    case Mixed = 'mixed';
    case Testing = 'sqlite';
}
