<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeHTMLResponse\Extracted;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type UnionMember2Variants = mixed|string
 * @phpstan-type UnionMember2Shape = UnionMember2Variants
 */
final class UnionMember2 implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', 'mixed'];
    }
}
