<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListParams;

enum Status: string
{
    case ACTIVE = 'active';

    case PAUSED = 'paused';

    case FAILED = 'failed';
}
