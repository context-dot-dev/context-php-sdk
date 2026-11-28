<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeResponse\Product\Data\Product\Variant;

/**
 * Stock or ordering availability of this variant.
 */
enum Availability: string
{
    case IN_STOCK = 'in_stock';

    case OUT_OF_STOCK = 'out_of_stock';

    case LIMITED_AVAILABILITY = 'limited_availability';

    case PREORDER = 'preorder';

    case BACKORDER = 'backorder';

    case MADE_TO_ORDER = 'made_to_order';

    case DISCONTINUED = 'discontinued';
}
