<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchCancelResponse;

/**
 * How pages were selected.
 */
enum Mode: string
{
    case SCRAPE = 'scrape';

    case CRAWL = 'crawl';
}
