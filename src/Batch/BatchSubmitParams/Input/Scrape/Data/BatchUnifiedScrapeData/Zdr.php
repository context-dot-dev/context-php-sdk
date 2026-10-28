<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData;

/**
 * Batches persist their results. Only disabled is supported; enabled returns ZDR_NOT_SUPPORTED.
 */
enum Zdr: string
{
    case DISABLED = 'disabled';
}
