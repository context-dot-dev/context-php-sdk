<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\ParseParams\PrebuiltParser;

/**
 * Parse Google Maps business data into data.results. Accepts Maps place, search, and internal data URLs. Uses a US exit and English labels regardless of hl or Accept-Language, and reads Maps data independently of DOM filters.
 */
enum Parser: string
{
    case GOOGLE_MAPS = 'google-maps';
}
