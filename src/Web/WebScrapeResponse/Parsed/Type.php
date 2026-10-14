<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeResponse\Parsed;

/**
 * The selected prebuilt parser name, or custom when type is omitted, custom rules are used, or parsing is not requested.
 */
enum Type: string
{
    case CUSTOM = 'custom';

    case GOOGLE_MAPS = 'google-maps';
}
