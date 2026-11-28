<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetChangeResponse;

/**
 * Type of target the monitor watches.
 */
enum TargetType: string
{
    case PAGE = 'page';

    case SITEMAP = 'sitemap';

    case EXTRACT = 'extract';

    case SEARCH = 'search';
}
