<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetChangeResponse\MonitorsExtractSemanticChange;

enum Importance: string
{
    case LOW = 'low';

    case MEDIUM = 'medium';

    case HIGH = 'high';
}
