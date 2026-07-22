<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeMdParams\Pdf;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebWebScrapeMdParams\Pdf\ShouldParse\UnionMember1;

/**
 * When true, PDF URLs are fetched and parsed. When false, PDF URLs are skipped and a 400 WEBSITE_ACCESS_ERROR is returned.
 *
 * @phpstan-type ShouldParseVariants = bool|value-of<UnionMember1>
 * @phpstan-type ShouldParseShape = ShouldParseVariants
 */
final class ShouldParse implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['bool', UnionMember1::class];
    }
}
