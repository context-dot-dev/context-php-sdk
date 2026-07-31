<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchListResponse\Data;

/**
 * How pages are selected.
 */
enum Mode: string
{
    case SCRAPE = 'scrape';

    case CRAWL = 'crawl';
}
