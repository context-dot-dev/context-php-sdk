<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScreenshotParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Optional browser viewport dimensions for the screenshot. Defaults to 1920x1080.
 *
 * @phpstan-type ViewportShape = array{height?: int|null, width?: int|null}
 */
final class Viewport implements BaseModel
{
    /** @use SdkModel<ViewportShape> */
    use SdkModel;

    /**
     * Viewport height in pixels.
     */
    #[Optional]
    public ?int $height;

    /**
     * Viewport width in pixels.
     */
    #[Optional]
    public ?int $width;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?int $height = null, ?int $width = null): self
    {
        $self = new self;

        null !== $height && $self['height'] = $height;
        null !== $width && $self['width'] = $width;

        return $self;
    }

    /**
     * Viewport height in pixels.
     */
    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Viewport width in pixels.
     */
    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
