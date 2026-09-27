<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractStyleguideParams\TimeoutOpts;

/**
 * "fail" returns 408 at the deadline. "return-partial" returns available results; inspect the response’s partial flag. "return-partial" requires at least 5000 ms.
 */
enum Behavior: string
{
    case FAIL = 'fail';

    case RETURN_PARTIAL = 'return-partial';
}
