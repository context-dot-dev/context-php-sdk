<?php

declare(strict_types=1);

namespace ContextDev\Web\WebSearchParams\TimeoutOpts;

/**
 * "fail" returns 408 at the deadline. "return-partial" returns available results; inspect the response’s partial flag.
 */
enum Behavior: string
{
    case FAIL = 'fail';

    case RETURN_PARTIAL = 'return-partial';
}
