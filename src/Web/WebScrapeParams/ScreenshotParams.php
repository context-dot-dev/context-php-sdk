<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScrapeParams\ScreenshotParams\Area;
use ContextDev\Web\WebScrapeParams\ScreenshotParams\Area\Element;
use ContextDev\Web\WebScrapeParams\ScreenshotParams\Area\Page;
use ContextDev\Web\WebScrapeParams\ScreenshotParams\Area\Rectangle;
use ContextDev\Web\WebScrapeParams\ScreenshotParams\Format;

/**
 * Screenshot options. Requires formats.screenshot: true.
 *
 * @phpstan-import-type AreaVariants from \ContextDev\Web\WebScrapeParams\ScreenshotParams\Area
 * @phpstan-import-type AreaShape from \ContextDev\Web\WebScrapeParams\ScreenshotParams\Area
 *
 * @phpstan-type ScreenshotParamsShape = array{
 *   area?: AreaShape|null, format?: null|Format|value-of<Format>
 * }
 */
final class ScreenshotParams implements BaseModel
{
    /** @use SdkModel<ScreenshotParamsShape> */
    use SdkModel;

    /**
     * Viewport, full page, one visible element, or a rectangle. Maximum 40 megapixels.
     *
     * @var AreaVariants|null $area
     */
    #[Optional(union: Area::class)]
    public Element|Rectangle|string|null $area;

    /** @var value-of<Format>|null $format */
    #[Optional(enum: Format::class)]
    public ?string $format;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param AreaShape|null $area
     * @param Format|value-of<Format>|null $format
     */
    public static function with(
        Page|Element|array|Rectangle|string|null $area = null,
        Format|string|null $format = null,
    ): self {
        $self = new self;

        null !== $area && $self['area'] = $area;
        null !== $format && $self['format'] = $format;

        return $self;
    }

    /**
     * Viewport, full page, one visible element, or a rectangle. Maximum 40 megapixels.
     *
     * @param AreaShape $area
     */
    public function withArea(Page|Element|array|Rectangle|string $area): self
    {
        $self = clone $this;
        $self['area'] = $area;

        return $self;
    }

    /**
     * @param Format|value-of<Format> $format
     */
    public function withFormat(Format|string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }
}
