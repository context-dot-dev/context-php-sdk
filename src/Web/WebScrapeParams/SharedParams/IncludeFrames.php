<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\SharedParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebScrapeParams\SharedParams\IncludeFrames\UnionMember1;

/**
 * Which iframe contents to include in HTML and text outputs. Screenshots always show visible frames. `auto` (default) inlines only iframes that hold page content, such as same-site documents, framesets, job boards, forms and embedded documents, and skips ads and widgets. `true` inlines every iframe. `false` inlines none.
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
