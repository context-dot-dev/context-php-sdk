<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorUpdateParams;

/**
 * Set `paused` to stop scheduled runs or `active` to resume them. A resumed monitor runs promptly instead of waiting a full interval.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case PAUSED = 'paused';
}
