<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\ParseParams\CustomParser;

/**
 * Extract fields using custom CSS rules. This is the default when type is omitted.
 */
enum Type: string
{
    case CUSTOM = 'custom';
}
