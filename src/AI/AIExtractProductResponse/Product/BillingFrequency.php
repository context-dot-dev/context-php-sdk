<?php

declare(strict_types=1);

namespace ContextDev\AI\AIExtractProductResponse\Product;

/**
 * Billing frequency for the product.
 */
enum BillingFrequency: string
{
    case MONTHLY = 'monthly';

    case YEARLY = 'yearly';

    case ONE_TIME = 'one_time';

    case USAGE_BASED = 'usage_based';
}
