<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\CacheMetadata;

/**
 * Whether the response was served from cache, required fresh work, or honored zero-data-retention cache bypass.
 */
enum Status: string
{
    case HIT = 'hit';

    case MISS = 'miss';

    case ZDR = 'zdr';
}
