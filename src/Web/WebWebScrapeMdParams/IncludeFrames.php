<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeMdParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebWebScrapeMdParams\IncludeFrames\UnionMember1;

/**
 * When true, the contents of iframes are rendered to Markdown.
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
