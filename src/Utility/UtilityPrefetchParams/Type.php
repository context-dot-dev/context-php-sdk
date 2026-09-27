<?php

declare(strict_types=1);

namespace ContextDev\Utility\UtilityPrefetchParams;

/**
 * Data to prefetch.
 */
enum Type: string
{
    case BRAND = 'brand';

    case STYLEGUIDE = 'styleguide';
}
