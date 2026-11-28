<?php

declare(strict_types=1);

namespace ContextDev\Web\WebSearchParams\MarkdownOptions;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebSearchParams\MarkdownOptions\IncludeFrames\UnionMember1;

/**
 * Which iframe contents to include in the Markdown. `auto` inlines only iframes that hold page content, such as same-site documents, framesets, job boards, forms, and embedded documents, and skips ads and widgets. `true` inlines every iframe; `false` inlines none.
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
