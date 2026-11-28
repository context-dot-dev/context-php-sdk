<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data;

/**
 * Zero data retention is not available for batches, because batches store their results. Sending `enabled` returns `ZDR_NOT_SUPPORTED`.
 */
enum Zdr: string
{
    case DISABLED = 'disabled';
}
