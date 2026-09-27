<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\ScreenshotParams\Area;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Pixels from the document origin.
 *
 * @phpstan-type RectangleShape = array{height: int, width: int, x: int, y: int}
 */
final class Rectangle implements BaseModel
{
    /** @use SdkModel<RectangleShape> */
    use SdkModel;

    /**
     * Height of the capture in pixels.
     */
    #[Required]
    public int $height;

    /**
     * Width of the capture in pixels.
     */
    #[Required]
    public int $width;

    /**
     * Left edge of the capture, in pixels from the document origin.
     */
    #[Required]
    public int $x;

    /**
     * Top edge of the capture, in pixels from the document origin.
     */
    #[Required]
    public int $y;

    /**
     * `new Rectangle()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Rectangle::with(height: ..., width: ..., x: ..., y: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Rectangle)->withHeight(...)->withWidth(...)->withX(...)->withY(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(int $height, int $width, int $x, int $y): self
    {
        $self = new self;

        $self['height'] = $height;
        $self['width'] = $width;
        $self['x'] = $x;
        $self['y'] = $y;

        return $self;
    }

    /**
     * Height of the capture in pixels.
     */
    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Width of the capture in pixels.
     */
    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }

    /**
     * Left edge of the capture, in pixels from the document origin.
     */
    public function withX(int $x): self
    {
        $self = clone $this;
        $self['x'] = $x;

        return $self;
    }

    /**
     * Top edge of the capture, in pixels from the document origin.
     */
    public function withY(int $y): self
    {
        $self = clone $this;
        $self['y'] = $y;

        return $self;
    }
}
