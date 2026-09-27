<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorUpdateParams;

/**
 * Set `paused` to stop scheduled runs or `active` to resume them.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case PAUSED = 'paused';
}
