<?php

declare(strict_types=1);

namespace ContextDev\Batch\CrawlControls;

use ContextDev\Batch\CrawlControls\Languages\UnionMember0;
use ContextDev\Batch\CrawlControls\Languages\UnionMember1;
use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Core\Conversion\ListOf;

/**
 * Languages whose pages were followed: `same_as_start_url` or a list of language codes. Null when every language was followed, which is always the case for a sitemap crawl.
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
