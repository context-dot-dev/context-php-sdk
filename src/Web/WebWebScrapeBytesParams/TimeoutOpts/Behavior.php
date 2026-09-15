<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeBytesParams\TimeoutOpts;

/**
 * What to do at the deadline. This endpoint supports "fail": return 408 REQUEST_TIMEOUT without charging credits.
 */
enum Behavior: string
{
    case FAIL = 'fail';
}
