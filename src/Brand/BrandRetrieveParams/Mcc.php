<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandRetrieveParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;

/**
 * Optional Merchant Category Code (MCC) to help identify the business category or industry.
 *
 * @phpstan-type MccVariants = string|float
 * @phpstan-type MccShape = MccVariants
 */
final class Mcc implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', 'float'];
    }
}
