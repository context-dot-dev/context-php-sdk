<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListParams;

/**
 * Filter by target type.
 */
enum TargetType: string
{
    case PAGE = 'page';

    case SITEMAP = 'sitemap';

    case EXTRACT = 'extract';
}
