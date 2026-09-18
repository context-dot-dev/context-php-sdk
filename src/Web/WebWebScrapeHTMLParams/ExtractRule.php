<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeHTMLParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebWebScrapeHTMLParams\ExtractRule\UnionMember1;

/**
 * @phpstan-import-type UnionMember1Shape from \ContextDev\Web\WebWebScrapeHTMLParams\ExtractRule\UnionMember1
 *
 * @phpstan-type ExtractRuleVariants = string|UnionMember1
 * @phpstan-type ExtractRuleShape = ExtractRuleVariants|UnionMember1Shape
 */
final class ExtractRule implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', UnionMember1::class];
    }
}
