<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractStyleguideResponse\Styleguide;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Spacing system used on the website.
 *
 * @phpstan-type ElementSpacingShape = array{
 *   lg: string, md: string, sm: string, xl: string, xs: string
 * }
 */
final class ElementSpacing implements BaseModel
{
    /** @use SdkModel<ElementSpacingShape> */
    use SdkModel;

    #[Required]
    public string $lg;

    #[Required]
    public string $md;

    #[Required]
    public string $sm;

    #[Required]
    public string $xl;

    #[Required]
    public string $xs;

    /**
     * `new ElementSpacing()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ElementSpacing::with(lg: ..., md: ..., sm: ..., xl: ..., xs: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ElementSpacing)
     *   ->withLg(...)
     *   ->withMd(...)
     *   ->withSm(...)
     *   ->withXl(...)
     *   ->withXs(...)
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
    public static function with(
        string $lg,
        string $md,
        string $sm,
        string $xl,
        string $xs
    ): self {
        $self = new self;

        $self['lg'] = $lg;
        $self['md'] = $md;
        $self['sm'] = $sm;
        $self['xl'] = $xl;
        $self['xs'] = $xs;

        return $self;
    }

    public function withLg(string $lg): self
    {
        $self = clone $this;
        $self['lg'] = $lg;

        return $self;
    }

    public function withMd(string $md): self
    {
        $self = clone $this;
        $self['md'] = $md;

        return $self;
    }

    public function withSm(string $sm): self
    {
        $self = clone $this;
        $self['sm'] = $sm;

        return $self;
    }

    public function withXl(string $xl): self
    {
        $self = clone $this;
        $self['xl'] = $xl;

        return $self;
    }

    public function withXs(string $xs): self
    {
        $self = clone $this;
        $self['xs'] = $xs;

        return $self;
    }
}
