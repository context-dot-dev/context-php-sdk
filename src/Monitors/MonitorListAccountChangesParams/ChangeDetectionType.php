<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListAccountChangesParams;

/**
 * Filter by change detection type.
 */
enum ChangeDetectionType: string
{
    case EXACT = 'exact';

    case SEMANTIC = 'semantic';
}
