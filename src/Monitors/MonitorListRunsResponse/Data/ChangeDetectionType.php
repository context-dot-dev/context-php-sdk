<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListRunsResponse\Data;

enum ChangeDetectionType: string
{
    case EXACT = 'exact';

    case SEMANTIC = 'semantic';
}
