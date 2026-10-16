<?php

declare(strict_types=1);

namespace ContextDev\Web\WebSearchParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Core\Conversion\ListOf;
use ContextDev\Web\WebSearchParams\Languages\UnionMember0;
use ContextDev\Web\WebSearchParams\Languages\UnionMember1;

/**
 * Languages to return results in, as BCP 47 language codes such as `en` or `de`, or "all" for any language. Defaults to "all". Example: ["en", "de"].
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
