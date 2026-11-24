<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\TimeoutOpts;

/**
 * "fail" returns 408 at the deadline. "return-partial" returns available results; inspect the response’s partial flag. "return-partial" requires at least 5000 ms. On POST /web/scrape, an output that is not ready in time fails with error_code REQUEST_TIMEOUT inside a 200 response under either behavior; 408 is returned only when the whole request cannot respond by the deadline.
 */
enum Behavior: string
{
    case FAIL = 'fail';

    case RETURN_PARTIAL = 'return-partial';
}
