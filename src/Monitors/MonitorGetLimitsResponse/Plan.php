<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetLimitsResponse;

/**
 * Your plan tier. `free` is Free, `starter` is Developer, `pro` is Pro or Growth, and `scale` is Scale or Enterprise.
 */
enum Plan: string
{
    case FREE = 'free';

    case STARTER = 'starter';

    case PRO = 'pro';

    case SCALE = 'scale';
}
