<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\SharedParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Browser size in pixels. Omit for 1920 × 1080. When provided, missing dimensions default to 1440 × 900.
 *
 * @phpstan-type ViewportShape = array{height?: int|null, width?: int|null}
 */
final class Viewport implements BaseModel
{
    /** @use SdkModel<ViewportShape> */
    use SdkModel;

    /**
     * Browser viewport height in pixels.
     */
    #[Optional]
    public ?int $height;

    /**
     * Browser viewport width in pixels.
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
     * Browser viewport height in pixels.
     */
    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Browser viewport width in pixels.
     */
    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
