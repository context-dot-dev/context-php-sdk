<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandGetResponse\Brand;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ColorShape = array{hex?: string|null, name?: string|null}
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

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $hex = null, ?string $name = null): self
    {
        $self = new self;

        null !== $hex && $self['hex'] = $hex;
        null !== $name && $self['name'] = $name;

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
}
