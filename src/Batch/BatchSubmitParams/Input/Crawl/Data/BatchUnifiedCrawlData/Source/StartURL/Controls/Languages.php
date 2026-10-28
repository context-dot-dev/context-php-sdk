<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\BatchUnifiedCrawlData\Source\StartURL\Controls;

use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\BatchUnifiedCrawlData\Source\StartURL\Controls\Languages\UnionMember0;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\BatchUnifiedCrawlData\Source\StartURL\Controls\Languages\UnionMember1;
use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Core\Conversion\ListOf;

/**
 * Only follow pages in these languages, or `same_as_start_url`; all languages when omitted.
 *
 * @phpstan-type LanguagesVariants = list<value-of<UnionMember1>>|value-of<UnionMember0>
 * @phpstan-type LanguagesShape = LanguagesVariants
 */
final class Languages implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [UnionMember0::class, new ListOf(UnionMember1::class)];
    }
}
