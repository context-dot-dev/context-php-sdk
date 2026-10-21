<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\StartURL\Controls;

use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\StartURL\Controls\Languages\UnionMember0;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\StartURL\Controls\Languages\UnionMember1;
use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Core\Conversion\ListOf;

/**
 * Languages whose pages are followed. `same_as_start_url` follows only the start page's language; a list of language codes such as `["en"]` follows those languages. Links whose language cannot be determined are followed. When omitted all urls are crawled.
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
