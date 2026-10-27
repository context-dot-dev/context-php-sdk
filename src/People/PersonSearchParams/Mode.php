<?php

declare(strict_types=1);

namespace ContextDev\People\PersonSearchParams;

/**
 * `fast` matches people on basic criteria (e.g. their role, location or background); `ultra` plans a deeper search, judges each candidate against every criterion in the query. Complex `ultra` searches can take up to 30 seconds to complete, so allow for that in your client timeout.
 */
enum Mode: string
{
    case FAST = 'fast';

    case ULTRA = 'ultra';
}
