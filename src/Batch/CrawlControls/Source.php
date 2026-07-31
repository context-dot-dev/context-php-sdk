<?php

declare(strict_types=1);

namespace ContextDev\Batch\CrawlControls;

use ContextDev\Batch\CrawlControls\Source\UnionMember0;
use ContextDev\Batch\CrawlControls\Source\UnionMember1;
use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;

/**
 * Where the crawl started.
 *
 * @phpstan-import-type UnionMember0Shape from \ContextDev\Batch\CrawlControls\Source\UnionMember0
 * @phpstan-import-type UnionMember1Shape from \ContextDev\Batch\CrawlControls\Source\UnionMember1
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
