<?php

declare(strict_types=1);

namespace ContextDev\People\PersonSearchParams;

/**
 * `fast` matches people on basic criteria (e.g. their role, location or background); `ultra` plans a deeper search, judges each candidate against every criterion in the query and explains each match.
 */
enum Mode: string
{
    case FAST = 'fast';

    case ULTRA = 'ultra';
}
