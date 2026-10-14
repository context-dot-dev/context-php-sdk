<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\ParseParams\CustomParser;

/**
 * Extract fields using custom CSS rules. This is the default when type is omitted.
 */
enum Type: string
{
    case CUSTOM = 'custom';
}
