<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchGetResponse;

/**
 * How pages were selected. Matches `input.mode` on the submit request.
 */
enum Mode: string
{
    case SCRAPE = 'scrape';

    case CRAWL = 'crawl';
}
