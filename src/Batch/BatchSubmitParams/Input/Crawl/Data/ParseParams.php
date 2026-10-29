<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data;

use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\ParseParams\UnionMember0;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\ParseParams\UnionMember1;
use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;

/**
 * Requires `formats.parse: true`; required when it is set.
 *
 * @phpstan-import-type UnionMember0Shape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\ParseParams\UnionMember0
 * @phpstan-import-type UnionMember1Shape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\ParseParams\UnionMember1
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
