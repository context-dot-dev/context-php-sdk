<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeMdParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebWebScrapeMdParams\UseMainContentOnly\UnionMember1;

/**
 * Extract only the main content of the page, excluding headers, footers, sidebars, and navigation.
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
