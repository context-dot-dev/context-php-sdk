<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebScrapeParams\ParseParams\UnionMember0;
use ContextDev\Web\WebScrapeParams\ParseParams\UnionMember1;

/**
 * Requires `formats.parse: true`; required when it is set.
 *
 * @phpstan-import-type UnionMember0Shape from \ContextDev\Web\WebScrapeParams\ParseParams\UnionMember0
 * @phpstan-import-type UnionMember1Shape from \ContextDev\Web\WebScrapeParams\ParseParams\UnionMember1
 *
 * @phpstan-type ParseParamsVariants = UnionMember0|UnionMember1
 * @phpstan-type ParseParamsShape = ParseParamsVariants|UnionMember0Shape|UnionMember1Shape
 */
final class ParseParams implements ConverterSource
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
