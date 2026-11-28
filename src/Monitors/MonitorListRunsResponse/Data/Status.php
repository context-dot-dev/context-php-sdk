<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListRunsResponse\Data;

/**
 * Run status. `skipped` runs never executed; `skip_reason` says why.
 */
enum Status: string
{
    case QUEUED = 'queued';

    case RUNNING = 'running';

    case COMPLETED = 'completed';

    case FAILED = 'failed';

    case SKIPPED = 'skipped';
}
