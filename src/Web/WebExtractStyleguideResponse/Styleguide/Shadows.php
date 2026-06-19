<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractStyleguideResponse\Styleguide;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Shadow styles used on the website.
 *
 * @phpstan-type ShadowsShape = array{
 *   inner: string, lg: string, md: string, sm: string, xl: string
 * }
 */
final class Shadows implements BaseModel
{
    /** @use SdkModel<ShadowsShape> */
    use SdkModel;

    #[Required]
    public string $inner;

    #[Required]
    public string $lg;

    #[Required]
    public string $md;

    #[Required]
    public string $sm;

    #[Required]
    public string $xl;

    /**
     * `new Shadows()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Shadows::with(inner: ..., lg: ..., md: ..., sm: ..., xl: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Shadows)
     *   ->withInner(...)
     *   ->withLg(...)
     *   ->withMd(...)
     *   ->withSm(...)
     *   ->withXl(...)
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
        string $inner,
        string $lg,
        string $md,
        string $sm,
        string $xl
    ): self {
        $self = new self;

        $self['inner'] = $inner;
        $self['lg'] = $lg;
        $self['md'] = $md;
        $self['sm'] = $sm;
        $self['xl'] = $xl;

        return $self;
    }

    public function withInner(string $inner): self
    {
        $self = clone $this;
        $self['inner'] = $inner;

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
}
