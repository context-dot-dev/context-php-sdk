<?php

declare(strict_types=1);

namespace ContextDev\Parse\ParseHandleParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Parse\ParseHandleParams\IncludeLinks\UnionMember1;

/**
 * Preserve hyperlinks in Markdown output.
 *
 * @phpstan-type IncludeLinksVariants = bool|value-of<UnionMember1>
 * @phpstan-type IncludeLinksShape = IncludeLinksVariants
 */
final class IncludeLinks implements ConverterSource
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
