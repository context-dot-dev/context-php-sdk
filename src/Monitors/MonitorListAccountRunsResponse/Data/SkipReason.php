<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListAccountRunsResponse\Data;

/**
 * Why the run was skipped; `superseded` means a concurrent run took its place or the monitor was deleted. `null` unless `status` is `skipped`.
 */
enum SkipReason: string
{
    case INSUFFICIENT_CREDITS = 'insufficient_credits';

    case MONITOR_PAUSED = 'monitor_paused';

    case SUPERSEDED = 'superseded';
}
