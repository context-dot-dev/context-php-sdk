<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetRunResponse;

/**
 * A baseline run follows creation or a target or detection change.
 */
enum RunType: string
{
    case BASELINE = 'baseline';

    case SCHEDULED = 'scheduled';
}
