<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListAccountChangesParams;

enum ChangeDetectionType: string
{
    case EXACT = 'exact';

    case SEMANTIC = 'semantic';
}
