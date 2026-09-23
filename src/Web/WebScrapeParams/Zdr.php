<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams;

/**
 * Zero data retention. Bypasses caches and uploads; excludes request/response content and tags from logs. Must be enabled for your organization. Not available with the highlights output.
 */
enum Zdr: string
{
    case ENABLED = 'enabled';

    case DISABLED = 'disabled';
}
