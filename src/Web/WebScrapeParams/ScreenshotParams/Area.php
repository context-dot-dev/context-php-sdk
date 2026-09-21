<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\ScreenshotParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebScrapeParams\ScreenshotParams\Area\Element;
use ContextDev\Web\WebScrapeParams\ScreenshotParams\Area\Page;
use ContextDev\Web\WebScrapeParams\ScreenshotParams\Area\Rectangle;

/**
 * Viewport, full page, one visible element, or a rectangle. Maximum 40 megapixels.
 *
 * @phpstan-import-type ElementShape from \ContextDev\Web\WebScrapeParams\ScreenshotParams\Area\Element
 * @phpstan-import-type RectangleShape from \ContextDev\Web\WebScrapeParams\ScreenshotParams\Area\Rectangle
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
