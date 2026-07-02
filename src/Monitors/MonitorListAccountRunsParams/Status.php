<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListAccountRunsParams;

/**
 * Lifecycle status of a run. `skipped` runs never executed — see `skip_reason` (insufficient credits, monitor paused, or superseded by a concurrent run).
 */
enum Status: string
{
    case QUEUED = 'queued';

    case RUNNING = 'running';

    case COMPLETED = 'completed';

    case FAILED = 'failed';

    case SKIPPED = 'skipped';
}
