<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListParams;

/**
 * How `q` matches. `prefix` matches the start of words and tolerates one typo, for search as you type; `exact` matches whole words only. Defaults to `prefix`.
 */
enum SearchType: string
{
    case EXACT = 'exact';

    case PREFIX = 'prefix';
}
