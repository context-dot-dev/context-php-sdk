<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\Metadata;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type AlternateShape = array{
 *   href: string, hreflang?: string|null, title?: string|null, type?: string|null
 * }
 */
final class Alternate implements BaseModel
{
    /** @use SdkModel<AlternateShape> */
    use SdkModel;

    /**
     * Absolute URL of the alternate version.
     */
    #[Required]
    public string $href;

    /**
     * Language or locale of the alternate version, when present.
     */
    #[Optional]
    public ?string $hreflang;

    /**
     * Title of the alternate version, when present.
     */
    #[Optional]
    public ?string $title;

    /**
     * MIME type of the alternate version, when present.
     */
    #[Optional]
    public ?string $type;

    /**
     * `new Alternate()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Alternate::with(href: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Alternate)->withHref(...)
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
        string $href,
        ?string $hreflang = null,
        ?string $title = null,
        ?string $type = null,
    ): self {
        $self = new self;

        $self['href'] = $href;

        null !== $hreflang && $self['hreflang'] = $hreflang;
        null !== $title && $self['title'] = $title;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * Absolute URL of the alternate version.
     */
    public function withHref(string $href): self
    {
        $self = clone $this;
        $self['href'] = $href;

        return $self;
    }

    /**
     * Language or locale of the alternate version, when present.
     */
    public function withHreflang(string $hreflang): self
    {
        $self = clone $this;
        $self['hreflang'] = $hreflang;

        return $self;
    }

    /**
     * Title of the alternate version, when present.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * MIME type of the alternate version, when present.
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
