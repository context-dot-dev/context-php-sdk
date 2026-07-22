<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeHTMLParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebWebScrapeHTMLParams\IncludeFrames\UnionMember1;

/**
 * When true, iframes are rendered inline into the returned HTML.
 *
 * @phpstan-type IncludeFramesVariants = bool|value-of<UnionMember1>
 * @phpstan-type IncludeFramesShape = IncludeFramesVariants
 */
final class IncludeFrames implements ConverterSource
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
