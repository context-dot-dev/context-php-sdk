<?php

declare(strict_types=1);

namespace ContextDev\Web\WebSearchParams;

/**
 * Restrict results to content published within this window.
 */
enum Freshness: string
{
    case LAST_24_HOURS = 'last_24_hours';

    case LAST_WEEK = 'last_week';

    case LAST_MONTH = 'last_month';

    case LAST_YEAR = 'last_year';
}
