<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorNewResponse\Schedule;

enum Unit: string
{
    case MINUTES = 'minutes';

    case HOURS = 'hours';

    case DAYS = 'days';
}
