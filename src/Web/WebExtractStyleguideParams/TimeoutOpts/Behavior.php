<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractStyleguideParams\TimeoutOpts;

/**
 * `fail` returns 408 at the deadline. `return-partial` returns the results collected so far and marks the response as partial. `return-partial` requires at least 5000 ms. On `POST /web/scrape`, an output that is not ready in time fails with `REQUEST_TIMEOUT` inside a 200 response under either behavior; 408 means the whole request could not respond by the deadline.
 */
enum Behavior: string
{
    case FAIL = 'fail';

    case RETURN_PARTIAL = 'return-partial';
}
