<?php

declare(strict_types=1);

namespace ContextDev\AI\AIExtractProductsResponse\Product;

/**
 * Pricing model for the product.
 */
enum PricingModel: string
{
    case PER_SEAT = 'per_seat';

    case FLAT = 'flat';

    case TIERED = 'tiered';

    case FREEMIUM = 'freemium';

    case CUSTOM = 'custom';
}
