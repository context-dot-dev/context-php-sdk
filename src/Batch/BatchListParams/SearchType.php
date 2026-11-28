<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchListParams;

/**
 * How `q` matches: `prefix` matches the start of a term, for search-as-you-type, and `exact` matches whole terms. Defaults to `prefix`.
 */
enum SearchType: string
{
    case EXACT = 'exact';

    case PREFIX = 'prefix';
}
