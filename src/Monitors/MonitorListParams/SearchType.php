<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListParams;

/**
 * `prefix` for as-you-type prefix matching (default), `exact` for full-token matching.
 */
enum SearchType: string
{
    case EXACT = 'exact';

    case PREFIX = 'prefix';
}
