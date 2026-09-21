<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\ParseParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebScrapeParams\ParseParams\Rule\UnionMember1;

/**
 * @phpstan-import-type UnionMember1Shape from \ContextDev\Web\WebScrapeParams\ParseParams\Rule\UnionMember1
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
