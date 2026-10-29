<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\ScreenshotParams;

use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\ScreenshotParams\Area\Selector;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\ScreenshotParams\Area\UnionMember0;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\ScreenshotParams\Area\UnionMember2;
use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;

/**
 * What to capture: `viewport`, `fullPage`, one element, or a rectangle. Max 40 megapixels.
 *
 * @phpstan-import-type SelectorShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\ScreenshotParams\Area\Selector
 * @phpstan-import-type UnionMember2Shape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\ScreenshotParams\Area\UnionMember2
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
