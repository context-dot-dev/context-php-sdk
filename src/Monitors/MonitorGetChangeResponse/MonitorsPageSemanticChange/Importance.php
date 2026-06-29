<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetChangeResponse\MonitorsPageSemanticChange;

enum Importance: string
{
    case LOW = 'low';

    case MEDIUM = 'medium';

    case HIGH = 'high';
}
