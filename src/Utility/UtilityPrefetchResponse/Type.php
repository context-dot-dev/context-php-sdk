<?php

declare(strict_types=1);

namespace ContextDev\Utility\UtilityPrefetchResponse;

/**
 * The type of prefetch that was queued, echoed from the request (currently always 'brand').
 */
enum Type: string
{
    case BRAND = 'brand';
}
