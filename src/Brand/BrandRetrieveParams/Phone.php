<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandRetrieveParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;

/**
 * Optional phone number from the transaction to help verify brand match.
 *
 * @phpstan-type PhoneVariants = string|float
 * @phpstan-type PhoneShape = PhoneVariants
 */
final class Phone implements ConverterSource
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
