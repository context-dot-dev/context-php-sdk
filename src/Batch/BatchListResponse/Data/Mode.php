<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchListResponse\Data;

/**
 * `scrape` for a URL list, `crawl` for a site crawl.
 */
enum Mode: string
{
    case SCRAPE = 'scrape';

    case CRAWL = 'crawl';
}
