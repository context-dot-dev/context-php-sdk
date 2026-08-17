<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandGetResponse\Brand;

use ContextDev\Brand\BrandGetResponse\Brand\Color\Source;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ColorShape = array{
 *   hex?: string|null, name?: string|null, source?: null|Source|value-of<Source>
 * }
 */
final class Color implements BaseModel
{
    /** @use SdkModel<ColorShape> */
    use SdkModel;

    /**
     * Color in hexadecimal format.
     */
    #[Optional]
    public ?string $hex;

    /**
     * Name of the color.
     */
    #[Optional]
    public ?string $name;

    /**
     * Where the color was observed: 'site' colors come from the website's own theme signals (rendered page colors, manifest, theme-color meta), 'logo' colors from logo image pixels.
     *
     * @var value-of<Source>|null $source
     */
    #[Optional(enum: Source::class)]
    public ?string $source;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Source|value-of<Source>|null $source
     */
    public static function with(
        ?string $hex = null,
        ?string $name = null,
        Source|string|null $source = null
    ): self {
        $self = new self;

        null !== $hex && $self['hex'] = $hex;
        null !== $name && $self['name'] = $name;
        null !== $source && $self['source'] = $source;

        return $self;
    }

    /**
     * Color in hexadecimal format.
     */
    public function withHex(string $hex): self
    {
        $self = clone $this;
        $self['hex'] = $hex;

        return $self;
    }

    /**
     * Name of the color.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Where the color was observed: 'site' colors come from the website's own theme signals (rendered page colors, manifest, theme-color meta), 'logo' colors from logo image pixels.
     *
     * @param Source|value-of<Source> $source
     */
    public function withSource(Source|string $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }
}
