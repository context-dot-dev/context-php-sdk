<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\BatchUnifiedCrawlData\ImageParams;

/**
 * Set `visual` to drop visual duplicates, keeping the largest copy.
 */
enum Dedupe: string
{
    case NONE = 'none';

    case VISUAL = 'visual';
}
