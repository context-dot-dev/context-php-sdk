<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandGetByTickerResponse\Brand;

use ContextDev\Brand\BrandGetByTickerResponse\Brand\Logo\Color;
use ContextDev\Brand\BrandGetByTickerResponse\Brand\Logo\Mode;
use ContextDev\Brand\BrandGetByTickerResponse\Brand\Logo\Resolution;
use ContextDev\Brand\BrandGetByTickerResponse\Brand\Logo\Type;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ColorShape from \ContextDev\Brand\BrandGetByTickerResponse\Brand\Logo\Color
 * @phpstan-import-type ResolutionShape from \ContextDev\Brand\BrandGetByTickerResponse\Brand\Logo\Resolution
 *
 * @phpstan-type LogoShape = array{
 *   colors?: list<\ContextDev\Brand\BrandGetByTickerResponse\Brand\Logo\Color|ColorShape>|null,
 *   mode?: null|Mode|value-of<Mode>,
 *   resolution?: null|Resolution|ResolutionShape,
 *   type?: null|Type|value-of<Type>,
 *   url?: string|null,
 * }
 */
final class Logo implements BaseModel
{
    /** @use SdkModel<LogoShape> */
    use SdkModel;

    /**
     * Array of colors in the logo.
     *
     * @var list<Color>|null $colors
     */
    #[Optional(
        list: Color::class
    )]
    public ?array $colors;

    /**
     * Indicates when this logo is best used: 'light' = best for light mode, 'dark' = best for dark mode, 'has_opaque_background' = can be used for either as image has its own background.
     *
     * @var value-of<Mode>|null $mode
     */
    #[Optional(enum: Mode::class)]
    public ?string $mode;

    /**
     * Resolution of the logo image.
     */
    #[Optional]
    public ?Resolution $resolution;

    /**
     * Type of the logo based on resolution (e.g., 'icon', 'logo').
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * CDN hosted url of the logo (ready for display).
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
     * @param Mode|value-of<Mode>|null $mode
     * @param Resolution|ResolutionShape|null $resolution
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        ?array $colors = null,
        Mode|string|null $mode = null,
        Resolution|array|null $resolution = null,
        Type|string|null $type = null,
        ?string $url = null,
    ): self {
        $self = new self;

        null !== $colors && $self['colors'] = $colors;
        null !== $mode && $self['mode'] = $mode;
        null !== $resolution && $self['resolution'] = $resolution;
        null !== $type && $self['type'] = $type;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    /**
     * Array of colors in the logo.
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
     * Indicates when this logo is best used: 'light' = best for light mode, 'dark' = best for dark mode, 'has_opaque_background' = can be used for either as image has its own background.
     *
     * @param Mode|value-of<Mode> $mode
     */
    public function withMode(Mode|string $mode): self
    {
        $self = clone $this;
        $self['mode'] = $mode;

        return $self;
    }

    /**
     * Resolution of the logo image.
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
     * Type of the logo based on resolution (e.g., 'icon', 'logo').
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * CDN hosted url of the logo (ready for display).
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
