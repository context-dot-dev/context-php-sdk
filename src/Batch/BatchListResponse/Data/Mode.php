<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchListResponse\Data;

/**
 * `scrape` (URL list) or `crawl`.
 */
enum Mode: string
{
    case SCRAPE = 'scrape';

    case CRAWL = 'crawl';
}
