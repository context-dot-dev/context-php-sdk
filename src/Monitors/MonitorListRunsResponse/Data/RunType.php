<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListRunsResponse\Data;

/**
 * The first run after monitor creation is a baseline run.
 */
enum RunType: string
{
    case BASELINE = 'baseline';

    case SCHEDULED = 'scheduled';
}
