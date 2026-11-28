<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetRunResponse;

/**
 * `baseline` runs capture a fresh baseline after creation or a target or detection change. `scheduled` runs, including on-demand ones, check for changes.
 */
enum RunType: string
{
    case BASELINE = 'baseline';

    case SCHEDULED = 'scheduled';
}
