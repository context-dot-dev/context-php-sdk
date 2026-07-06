<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorUpdateParams;

enum Status: string
{
    case ACTIVE = 'active';

    case PAUSED = 'paused';
}
