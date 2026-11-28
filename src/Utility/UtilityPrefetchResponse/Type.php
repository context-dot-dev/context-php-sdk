<?php

declare(strict_types=1);

namespace ContextDev\Utility\UtilityPrefetchResponse;

/**
 * Data type that was queued, from the request.
 */
enum Type: string
{
    case BRAND = 'brand';

    case STYLEGUIDE = 'styleguide';
}
