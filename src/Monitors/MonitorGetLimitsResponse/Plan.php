<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetLimitsResponse;

/**
 * `starter` means Developer; `pro` means Pro or Growth; `scale` means Scale or Enterprise.
 */
enum Plan: string
{
    case FREE = 'free';

    case STARTER = 'starter';

    case PRO = 'pro';

    case SCALE = 'scale';
}
