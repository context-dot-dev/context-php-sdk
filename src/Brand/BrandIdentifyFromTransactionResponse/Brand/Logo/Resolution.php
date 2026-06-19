<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandIdentifyFromTransactionResponse\Brand\Logo;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Resolution of the logo image.
 *
 * @phpstan-type ResolutionShape = array{
 *   aspectRatio?: float|null, height?: int|null, width?: int|null
 * }
 */
final class Resolution implements BaseModel
{
    /** @use SdkModel<ResolutionShape> */
    use SdkModel;

    /**
     * Aspect ratio of the image (width/height).
     */
    #[Optional('aspect_ratio')]
    public ?float $aspectRatio;

    /**
     * Height of the image in pixels.
     */
    #[Optional]
    public ?int $height;

    /**
     * Width of the image in pixels.
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
    public static function with(
        ?float $aspectRatio = null,
        ?int $height = null,
        ?int $width = null
    ): self {
        $self = new self;

        null !== $aspectRatio && $self['aspectRatio'] = $aspectRatio;
        null !== $height && $self['height'] = $height;
        null !== $width && $self['width'] = $width;

        return $self;
    }

    /**
     * Aspect ratio of the image (width/height).
     */
    public function withAspectRatio(float $aspectRatio): self
    {
        $self = clone $this;
        $self['aspectRatio'] = $aspectRatio;

        return $self;
    }

    /**
     * Height of the image in pixels.
     */
    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Width of the image in pixels.
     */
    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
