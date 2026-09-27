<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorNewResponse\Schedule;

/**
 * Use `interval` to run on a repeating schedule.
 */
enum Type: string
{
    case INTERVAL = 'interval';
}
