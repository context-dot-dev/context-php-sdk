<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchListParams;

/**
 * `prefix` for as-you-type prefix matching (default), `exact` for full-token matching.
 */
enum SearchType: string
{
    case EXACT = 'exact';

    case PREFIX = 'prefix';
}
