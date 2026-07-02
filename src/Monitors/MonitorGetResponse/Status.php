<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetResponse;

/**
 * Monitor lifecycle status. `failed` means the most recent run failed (see the monitor's `last_error`); failed monitors keep running on schedule and flip back to `active` on the next successful run. Monitors are auto-`paused` after repeated consecutive failures or insufficient-credit skips; resume by PATCHing status to `active`.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case PAUSED = 'paused';

    case FAILED = 'failed';
}
