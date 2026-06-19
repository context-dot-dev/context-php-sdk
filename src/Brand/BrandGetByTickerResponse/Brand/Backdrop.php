<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandGetByTickerResponse\Brand;

use ContextDev\Brand\BrandGetByTickerResponse\Brand\Backdrop\Color;
use ContextDev\Brand\BrandGetByTickerResponse\Brand\Backdrop\Resolution;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ColorShape from \ContextDev\Brand\BrandGetByTickerResponse\Brand\Backdrop\Color
 * @phpstan-import-type ResolutionShape from \ContextDev\Brand\BrandGetByTickerResponse\Brand\Backdrop\Resolution
 *
 * @phpstan-type BackdropShape = array{
 *   colors?: list<\ContextDev\Brand\BrandGetByTickerResponse\Brand\Backdrop\Color|ColorShape>|null,
 *   resolution?: null|Resolution|ResolutionShape,
 *   url?: string|null,
 * }
 */
final class Backdrop implements BaseModel
{
    /** @use SdkModel<BackdropShape> */
    use SdkModel;

    /**
     * Array of colors in the backdrop image.
     *
     * @var list<Color>|null $colors
     */
    #[Optional(
        list: Color::class
    )]
    public ?array $colors;

    /**
     * Resolution of the backdrop image.
     */
    #[Optional]
    public ?Resolution $resolution;

    /**
     * URL of the backdrop image.
     */
    #[Optional]
    public ?string $url;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Color|ColorShape>|null $colors
     * @param Resolution|ResolutionShape|null $resolution
     */
    public static function with(
        ?array $colors = null,
        Resolution|array|null $resolution = null,
        ?string $url = null,
    ): self {
        $self = new self;

        null !== $colors && $self['colors'] = $colors;
        null !== $resolution && $self['resolution'] = $resolution;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    /**
     * Array of colors in the backdrop image.
     *
     * @param list<Color|ColorShape> $colors
     */
    public function withColors(array $colors): self
    {
        $self = clone $this;
        $self['colors'] = $colors;

        return $self;
    }

    /**
     * Resolution of the backdrop image.
     *
     * @param Resolution|ResolutionShape $resolution
     */
    public function withResolution(Resolution|array $resolution): self
    {
        $self = clone $this;
        $self['resolution'] = $resolution;

        return $self;
    }

    /**
     * URL of the backdrop image.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
