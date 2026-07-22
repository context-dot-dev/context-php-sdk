<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetLimitsResponse;

/**
 * The plan tier the limit was resolved from.
 */
enum Plan: string
{
    case FREE = 'free';

    case STARTER = 'starter';

    case PRO = 'pro';

    case SCALE = 'scale';
}
