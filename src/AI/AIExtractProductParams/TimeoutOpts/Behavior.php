<?php

declare(strict_types=1);

namespace ContextDev\AI\AIExtractProductParams\TimeoutOpts;

/**
 * What to do at the deadline. "fail" returns 408 REQUEST_TIMEOUT without charging credits. "return-partial" returns usable results collected so far; if none are available, the request still fails without charging credits. Partial results are not cached as complete results.
 */
enum Behavior: string
{
    case FAIL = 'fail';

    case RETURN_PARTIAL = 'return-partial';
}
