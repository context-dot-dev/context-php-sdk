<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListResponse\Data\Schedule;

/**
 * Time unit used with `frequency` to set the run interval.
 */
enum Unit: string
{
    case MINUTES = 'minutes';

    case HOURS = 'hours';

    case DAYS = 'days';
}
