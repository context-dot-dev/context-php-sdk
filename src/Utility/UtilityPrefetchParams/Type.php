<?php

declare(strict_types=1);

namespace ContextDev\Utility\UtilityPrefetchParams;

/**
 * What to prefetch. Currently only 'brand' is supported.
 */
enum Type: string
{
    case BRAND = 'brand';
}
