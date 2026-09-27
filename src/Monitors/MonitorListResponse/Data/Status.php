<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListResponse\Data;

/**
 * Current state. Failed monitors keep running; paused monitors must be resumed with `status: "active"`.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case PAUSED = 'paused';

    case FAILED = 'failed';
}
