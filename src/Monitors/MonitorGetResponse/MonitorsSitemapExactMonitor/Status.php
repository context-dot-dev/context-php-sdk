<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetResponse\MonitorsSitemapExactMonitor;

enum Status: string
{
    case ACTIVE = 'active';

    case PAUSED = 'paused';

    case FAILED = 'failed';
}
