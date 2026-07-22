<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeMdParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebWebScrapeMdParams\IncludeImages\UnionMember1;

/**
 * Include image references in Markdown output.
 *
 * @phpstan-type IncludeImagesVariants = bool|value-of<UnionMember1>
 * @phpstan-type IncludeImagesShape = IncludeImagesVariants
 */
final class IncludeImages implements ConverterSource
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
