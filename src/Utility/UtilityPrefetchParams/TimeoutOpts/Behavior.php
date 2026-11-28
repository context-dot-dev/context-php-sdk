<?php

declare(strict_types=1);

namespace ContextDev\Utility\UtilityPrefetchParams\TimeoutOpts;

/**
 * Only `fail` is supported: the request returns 408 at the deadline.
 */
enum Behavior: string
{
    case FAIL = 'fail';
}
