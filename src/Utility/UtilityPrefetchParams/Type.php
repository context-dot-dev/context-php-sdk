<?php

declare(strict_types=1);

namespace ContextDev\Utility\UtilityPrefetchParams;

/**
 * What to prefetch: 'brand' warms the brand data cache, 'styleguide' warms the styleguide cache.
 */
enum Type: string
{
    case BRAND = 'brand';

    case STYLEGUIDE = 'styleguide';
}
