<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetChangeResponse;

/**
 * How important the change is. Set by `semantic` detection only.
 */
enum Importance: string
{
    case LOW = 'low';

    case MEDIUM = 'medium';

    case HIGH = 'high';
}
