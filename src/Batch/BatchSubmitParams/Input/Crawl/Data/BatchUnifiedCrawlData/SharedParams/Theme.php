<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\BatchUnifiedCrawlData\SharedParams;

/**
 * Emulate a light or dark color scheme.
 */
enum Theme: string
{
    case LIGHT = 'light';

    case DARK = 'dark';
}
