<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeHTMLResponse;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Core\Conversion\ListOf;
use ContextDev\Web\WebWebScrapeHTMLResponse\Extracted\UnionMember2;

/**
 * @phpstan-import-type UnionMember2Shape from \ContextDev\Web\WebWebScrapeHTMLResponse\Extracted\UnionMember2
 *
 * @phpstan-type ExtractedVariants = mixed|string|list<mixed|string|null>
 * @phpstan-type ExtractedShape = ExtractedVariants|list<UnionMember2Shape>
 */
final class Extracted implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', 'mixed', new ListOf(UnionMember2::class, nullable: true)];
    }
}
