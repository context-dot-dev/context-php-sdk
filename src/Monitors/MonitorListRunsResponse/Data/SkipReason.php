<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListRunsResponse\Data;

/**
 * Why a skipped run never executed; null unless status is `skipped`.
 */
enum SkipReason: string
{
    case INSUFFICIENT_CREDITS = 'insufficient_credits';

    case MONITOR_PAUSED = 'monitor_paused';

    case SUPERSEDED = 'superseded';
}
