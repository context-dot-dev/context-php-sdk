<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractStyleguideResponse\Styleguide\FontLink;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type FaceShape = array{
 *   style: string,
 *   url: string,
 *   weight: string,
 *   unicodeRange?: string|null,
 *   width?: string|null,
 * }
 */
final class Face implements BaseModel
{
    /** @use SdkModel<FaceShape> */
    use SdkModel;

    /**
     * CSS font-style descriptor: normal, italic, or oblique, including an optional oblique angle or angle range (e.g. oblique 10deg 20deg).
     */
    #[Required]
    public string $style;

    /**
     * Preferred font file URL or inline font data URL.
     */
    #[Required]
    public string $url;

    /**
     * CSS font-weight descriptor. A variable font file can have a range such as "300 500", covering intermediate weights without separate files.
     */
    #[Required]
    public string $weight;

    /**
     * CSS unicode-range descriptor.
     */
    #[Optional]
    public ?string $unicodeRange;

    /**
     * CSS font-width or font-stretch descriptor.
     */
    #[Optional]
    public ?string $width;

    /**
     * `new Face()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Face::with(style: ..., url: ..., weight: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Face)->withStyle(...)->withURL(...)->withWeight(...)
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
        string $style,
        string $url,
        string $weight,
        ?string $unicodeRange = null,
        ?string $width = null,
    ): self {
        $self = new self;

        $self['style'] = $style;
        $self['url'] = $url;
        $self['weight'] = $weight;

        null !== $unicodeRange && $self['unicodeRange'] = $unicodeRange;
        null !== $width && $self['width'] = $width;

        return $self;
    }

    /**
     * CSS font-style descriptor: normal, italic, or oblique, including an optional oblique angle or angle range (e.g. oblique 10deg 20deg).
     */
    public function withStyle(string $style): self
    {
        $self = clone $this;
        $self['style'] = $style;

        return $self;
    }

    /**
     * Preferred font file URL or inline font data URL.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * CSS font-weight descriptor. A variable font file can have a range such as "300 500", covering intermediate weights without separate files.
     */
    public function withWeight(string $weight): self
    {
        $self = clone $this;
        $self['weight'] = $weight;

        return $self;
    }

    /**
     * CSS unicode-range descriptor.
     */
    public function withUnicodeRange(string $unicodeRange): self
    {
        $self = clone $this;
        $self['unicodeRange'] = $unicodeRange;

        return $self;
    }

    /**
     * CSS font-width or font-stretch descriptor.
     */
    public function withWidth(string $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
