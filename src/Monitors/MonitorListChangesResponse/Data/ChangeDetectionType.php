<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListChangesResponse\Data;

/**
 * Change detection type the monitor uses.
 */
enum ChangeDetectionType: string
{
    case EXACT = 'exact';

    case SEMANTIC = 'semantic';
}
