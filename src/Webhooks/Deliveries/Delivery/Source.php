<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries\Delivery;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Webhooks\Deliveries\Delivery\Source\UnionMember0;
use ContextDev\Webhooks\Deliveries\Delivery\Source\UnionMember1;

/**
 * @phpstan-import-type UnionMember0Shape from \ContextDev\Webhooks\Deliveries\Delivery\Source\UnionMember0
 * @phpstan-import-type UnionMember1Shape from \ContextDev\Webhooks\Deliveries\Delivery\Source\UnionMember1
 *
 * @phpstan-type SourceVariants = UnionMember0|UnionMember1
 * @phpstan-type SourceShape = SourceVariants|UnionMember0Shape|UnionMember1Shape
 */
final class Source implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [UnionMember0::class, UnionMember1::class];
    }
}
