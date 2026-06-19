<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeImagesResponse\Image;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebScrapeImagesResponse\Image\Enrichment\Type;

/**
 * Requested metadata for images that could be processed.
 *
 * @phpstan-type EnrichmentShape = array{
 *   height?: int|null,
 *   mimetype?: string|null,
 *   type?: null|\ContextDev\Web\WebWebScrapeImagesResponse\Image\Enrichment\Type|value-of<\ContextDev\Web\WebWebScrapeImagesResponse\Image\Enrichment\Type>,
 *   url?: string|null,
 *   width?: int|null,
 * }
 */
final class Enrichment implements BaseModel
{
    /** @use SdkModel<EnrichmentShape> */
    use SdkModel;

    /**
     * Image height in pixels, when measured.
     */
    #[Optional]
    public ?int $height;

    /**
     * Detected MIME type, when hosted.
     */
    #[Optional]
    public ?string $mimetype;

    /**
     * Visual asset category, when classified.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(
        enum: Type::class,
    )]
    public ?string $type;

    /**
     * Brand.dev CDN URL, when hosted.
     */
    #[Optional]
    public ?string $url;

    /**
     * Image width in pixels, when measured.
     */
    #[Optional]
    public ?int $width;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        ?int $height = null,
        ?string $mimetype = null,
        Type|string|null $type = null,
        ?string $url = null,
        ?int $width = null,
    ): self {
        $self = new self;

        null !== $height && $self['height'] = $height;
        null !== $mimetype && $self['mimetype'] = $mimetype;
        null !== $type && $self['type'] = $type;
        null !== $url && $self['url'] = $url;
        null !== $width && $self['width'] = $width;

        return $self;
    }

    /**
     * Image height in pixels, when measured.
     */
    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Detected MIME type, when hosted.
     */
    public function withMimetype(string $mimetype): self
    {
        $self = clone $this;
        $self['mimetype'] = $mimetype;

        return $self;
    }

    /**
     * Visual asset category, when classified.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(
        Type|string $type,
    ): self {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Brand.dev CDN URL, when hosted.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Image width in pixels, when measured.
     */
    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
