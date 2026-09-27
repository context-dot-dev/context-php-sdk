<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams;

/**
 * `enabled` turns on zero data retention. Your organization must have ZDR enabled.
 */
enum Zdr: string
{
    case ENABLED = 'enabled';

    case DISABLED = 'disabled';
}
