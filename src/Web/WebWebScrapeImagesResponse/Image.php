<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeImagesResponse;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebScrapeImagesResponse\Image\Element;
use ContextDev\Web\WebWebScrapeImagesResponse\Image\Enrichment;
use ContextDev\Web\WebWebScrapeImagesResponse\Image\Type;

/**
 * @phpstan-import-type EnrichmentShape from \ContextDev\Web\WebWebScrapeImagesResponse\Image\Enrichment
 *
 * @phpstan-type ImageShape = array{
 *   alt: string|null,
 *   element: Element|value-of<Element>,
 *   src: string,
 *   type: Type|value-of<Type>,
 *   enrichment?: null|Enrichment|EnrichmentShape,
 * }
 */
final class Image implements BaseModel
{
    /** @use SdkModel<ImageShape> */
    use SdkModel;

    /**
     * Image alt text, or null when unavailable.
     */
    #[Required]
    public ?string $alt;

    /**
     * Where the image was found.
     *
     * @var value-of<Element> $element
     */
    #[Required(enum: Element::class)]
    public string $element;

    /**
     * Original image value: URL, inline SVG or HTML, or base64 data URI.
     */
    #[Required]
    public string $src;

    /**
     * Format of src.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Requested metadata for images that could be processed.
     */
    #[Optional]
    public ?Enrichment $enrichment;

    /**
     * `new Image()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Image::with(alt: ..., element: ..., src: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Image)->withAlt(...)->withElement(...)->withSrc(...)->withType(...)
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
     *
     * @param Element|value-of<Element> $element
     * @param Type|value-of<Type> $type
     * @param Enrichment|EnrichmentShape|null $enrichment
     */
    public static function with(
        ?string $alt,
        Element|string $element,
        string $src,
        Type|string $type,
        Enrichment|array|null $enrichment = null,
    ): self {
        $self = new self;

        $self['alt'] = $alt;
        $self['element'] = $element;
        $self['src'] = $src;
        $self['type'] = $type;

        null !== $enrichment && $self['enrichment'] = $enrichment;

        return $self;
    }

    /**
     * Image alt text, or null when unavailable.
     */
    public function withAlt(?string $alt): self
    {
        $self = clone $this;
        $self['alt'] = $alt;

        return $self;
    }

    /**
     * Where the image was found.
     *
     * @param Element|value-of<Element> $element
     */
    public function withElement(Element|string $element): self
    {
        $self = clone $this;
        $self['element'] = $element;

        return $self;
    }

    /**
     * Original image value: URL, inline SVG or HTML, or base64 data URI.
     */
    public function withSrc(string $src): self
    {
        $self = clone $this;
        $self['src'] = $src;

        return $self;
    }

    /**
     * Format of src.
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
     * Requested metadata for images that could be processed.
     *
     * @param Enrichment|EnrichmentShape $enrichment
     */
    public function withEnrichment(Enrichment|array $enrichment): self
    {
        $self = clone $this;
        $self['enrichment'] = $enrichment;

        return $self;
    }
}
