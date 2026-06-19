<?php

declare(strict_types=1);

namespace ContextDev\AI\AIExtractProductResponse;

/**
 * The detected ecommerce platform, or null if not a product page.
 */
enum Platform: string
{
    case AMAZON = 'amazon';

    case TIKTOK_SHOP = 'tiktok_shop';

    case ETSY = 'etsy';

    case GENERIC = 'generic';
}
