<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\ScreenshotParams;

use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\ScreenshotParams\Area\Element;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\ScreenshotParams\Area\Page;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\ScreenshotParams\Area\Rectangle;
use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;

/**
 * What to capture: `viewport`, `fullPage`, one element, or a rectangle. Max 40 megapixels.
 *
 * @phpstan-import-type ElementShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\ScreenshotParams\Area\Element
 * @phpstan-import-type RectangleShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\ScreenshotParams\Area\Rectangle
 *
 * @phpstan-type AreaVariants = Element|Rectangle|value-of<Page>
 * @phpstan-type AreaShape = AreaVariants|ElementShape|RectangleShape
 */
final class Area implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [Page::class, Element::class, Rectangle::class];
    }
}
