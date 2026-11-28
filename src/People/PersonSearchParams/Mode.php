<?php

declare(strict_types=1);

namespace ContextDev\People\PersonSearchParams;

/**
 * `fast` matches people on basic criteria such as role, location, or background; `ultra` runs a deeper search, checks every candidate against each criterion in your query, and adds a `match` score. Complex `ultra` searches can take up to 30 seconds, so set your client timeout to match.
 */
enum Mode: string
{
    case FAST = 'fast';

    case ULTRA = 'ultra';
}
