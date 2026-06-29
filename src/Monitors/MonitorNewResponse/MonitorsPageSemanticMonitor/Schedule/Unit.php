<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorNewResponse\MonitorsPageSemanticMonitor\Schedule;

enum Unit: string
{
    case MINUTES = 'minutes';

    case HOURS = 'hours';

    case DAYS = 'days';
}
