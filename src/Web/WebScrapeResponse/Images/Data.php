<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeResponse\Images;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScrapeResponse\Images\Data\Classification;

/**
 * @phpstan-type DataShape = array{
 *   alt: string|null,
 *   url: string,
 *   classification?: null|Classification|value-of<Classification>,
 *   fileURL?: string|null,
 *   height?: int|null,
 *   width?: int|null,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Alt text. `null` when the image has none.
     */
    #[Required]
    public ?string $alt;

    /**
     * Image URL, or a data URI for inline images.
     */
    #[Required]
    public string $url;

    /**
     * What the image shows, such as a photo, logo, or icon. Requires `classification` enrichment.
     *
     * @var value-of<Classification>|null $classification
     */
    #[Optional(enum: Classification::class)]
    public ?string $classification;

    /**
     * Hosted copy of the image, valid for 24 hours after capture. Requires `file` enrichment; not returned with ZDR.
     */
    #[Optional('fileUrl')]
    public ?string $fileURL;

    /**
     * Image height in pixels. Requires `dimensions` enrichment.
     */
    #[Optional]
    public ?int $height;

    /**
     * Image width in pixels. Requires `dimensions` enrichment.
     */
    #[Optional]
    public ?int $width;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(alt: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)->withAlt(...)->withURL(...)
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
     * @param Classification|value-of<Classification>|null $classification
     */
    public static function with(
        ?string $alt,
        string $url,
        Classification|string|null $classification = null,
        ?string $fileURL = null,
        ?int $height = null,
        ?int $width = null,
    ): self {
        $self = new self;

        $self['alt'] = $alt;
        $self['url'] = $url;

        null !== $classification && $self['classification'] = $classification;
        null !== $fileURL && $self['fileURL'] = $fileURL;
        null !== $height && $self['height'] = $height;
        null !== $width && $self['width'] = $width;

        return $self;
    }

    /**
     * Alt text. `null` when the image has none.
     */
    public function withAlt(?string $alt): self
    {
        $self = clone $this;
        $self['alt'] = $alt;

        return $self;
    }

    /**
     * Image URL, or a data URI for inline images.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * What the image shows, such as a photo, logo, or icon. Requires `classification` enrichment.
     *
     * @param Classification|value-of<Classification> $classification
     */
    public function withClassification(
        Classification|string $classification
    ): self {
        $self = clone $this;
        $self['classification'] = $classification;

        return $self;
    }

    /**
     * Hosted copy of the image, valid for 24 hours after capture. Requires `file` enrichment; not returned with ZDR.
     */
    public function withFileURL(string $fileURL): self
    {
        $self = clone $this;
        $self['fileURL'] = $fileURL;

        return $self;
    }

    /**
     * Image height in pixels. Requires `dimensions` enrichment.
     */
    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Image width in pixels. Requires `dimensions` enrichment.
     */
    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
