<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeHTMLParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebWebScrapeHTMLParams\UseMainContentOnly\UnionMember1;

/**
 * When true, return only the page's main content in the HTML response, excluding headers, footers, sidebars, and navigation when detectable.
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
