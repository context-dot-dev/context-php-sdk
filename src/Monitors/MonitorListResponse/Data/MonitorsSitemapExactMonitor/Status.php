<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListResponse\Data\MonitorsSitemapExactMonitor;

enum Status: string
{
    case ACTIVE = 'active';

    case PAUSED = 'paused';

    case FAILED = 'failed';
}
