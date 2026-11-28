<?php

declare(strict_types=1);

namespace ContextDev\Industry\IndustryRetrieveNaicsParams\TimeoutOpts;

/**
 * `fail` returns 408 at the deadline. `return-partial` returns the results collected so far and marks the response as partial.
 */
enum Behavior: string
{
    case FAIL = 'fail';

    case RETURN_PARTIAL = 'return-partial';
}
