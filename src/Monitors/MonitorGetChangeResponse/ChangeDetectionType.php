<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetChangeResponse;

enum ChangeDetectionType: string
{
    case EXACT = 'exact';

    case SEMANTIC = 'semantic';
}
