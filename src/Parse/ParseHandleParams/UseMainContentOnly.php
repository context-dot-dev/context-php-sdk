<?php

declare(strict_types=1);

namespace ContextDev\Parse\ParseHandleParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Parse\ParseHandleParams\UseMainContentOnly\UnionMember1;

/**
 * Extract only the main content from HTML-like inputs.
 *
 * @phpstan-type UseMainContentOnlyVariants = bool|value-of<UnionMember1>
 * @phpstan-type UseMainContentOnlyShape = UseMainContentOnlyVariants
 */
final class UseMainContentOnly implements ConverterSource
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
