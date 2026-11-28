<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebCrawlMdResponse\CacheMetadata;

/**
 * `hit` when served from cache, `miss` when fetched fresh, `zdr` when zero data retention bypassed the cache.
 */
enum Status: string
{
    case HIT = 'hit';

    case MISS = 'miss';

    case ZDR = 'zdr';
}
