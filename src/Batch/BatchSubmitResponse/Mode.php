<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitResponse;

/**
 * How pages will be selected.
 */
enum Mode: string
{
    case SCRAPE = 'scrape';

    case CRAWL = 'crawl';
}
