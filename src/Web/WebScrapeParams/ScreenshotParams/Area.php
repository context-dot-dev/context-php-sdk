<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\ScreenshotParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebScrapeParams\ScreenshotParams\Area\Selector;
use ContextDev\Web\WebScrapeParams\ScreenshotParams\Area\UnionMember0;
use ContextDev\Web\WebScrapeParams\ScreenshotParams\Area\UnionMember2;

/**
 * What to capture: `viewport`, `fullPage`, one element, or a rectangle. Max 40 megapixels.
 *
 * @phpstan-import-type SelectorShape from \ContextDev\Web\WebScrapeParams\ScreenshotParams\Area\Selector
 * @phpstan-import-type UnionMember2Shape from \ContextDev\Web\WebScrapeParams\ScreenshotParams\Area\UnionMember2
 *
 * @phpstan-type AreaVariants = Selector|UnionMember2|value-of<UnionMember0>
 * @phpstan-type AreaShape = AreaVariants|SelectorShape|UnionMember2Shape
 */
final class Area implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [UnionMember0::class, Selector::class, UnionMember2::class];
    }
}
