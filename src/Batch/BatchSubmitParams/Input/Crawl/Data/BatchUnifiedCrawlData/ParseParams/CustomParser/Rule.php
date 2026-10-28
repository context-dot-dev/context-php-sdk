<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\BatchUnifiedCrawlData\ParseParams\CustomParser;

use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\BatchUnifiedCrawlData\ParseParams\CustomParser\Rule\UnionMember1;
use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type UnionMember1Shape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\BatchUnifiedCrawlData\ParseParams\CustomParser\Rule\UnionMember1
 *
 * @phpstan-type RuleVariants = string|UnionMember1
 * @phpstan-type RuleShape = RuleVariants|UnionMember1Shape
 */
final class Rule implements ConverterSource
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
