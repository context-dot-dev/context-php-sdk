<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeImagesParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Optional per-image processing, sent as deep-object query params such as enrichment[resolution]=true.
 *
 * @phpstan-type EnrichmentShape = array{
 *   classification?: bool|null,
 *   hostedURL?: bool|null,
 *   maxTimePerMs?: int|null,
 *   resolution?: bool|null,
 * }
 */
final class Enrichment implements BaseModel
{
    /** @use SdkModel<EnrichmentShape> */
    use SdkModel;

    /**
     * Classify each image by visual asset type.
     */
    #[Optional]
    public ?bool $classification;

    /**
     * Host materializable images on the Brand.dev CDN and return their URL and MIME type.
     */
    #[Optional('hostedUrl')]
    public ?bool $hostedURL;

    /**
     * Per-image enrichment timeout in milliseconds. Default: 30000. Maximum: 60000.
     */
    #[Optional]
    public ?int $maxTimePerMs;

    /**
     * Measure image width and height when possible.
     */
    #[Optional]
    public ?bool $resolution;

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
        ?bool $classification = null,
        ?bool $hostedURL = null,
        ?int $maxTimePerMs = null,
        ?bool $resolution = null,
    ): self {
        $self = new self;

        null !== $classification && $self['classification'] = $classification;
        null !== $hostedURL && $self['hostedURL'] = $hostedURL;
        null !== $maxTimePerMs && $self['maxTimePerMs'] = $maxTimePerMs;
        null !== $resolution && $self['resolution'] = $resolution;

        return $self;
    }

    /**
     * Classify each image by visual asset type.
     */
    public function withClassification(bool $classification): self
    {
        $self = clone $this;
        $self['classification'] = $classification;

        return $self;
    }

    /**
     * Host materializable images on the Brand.dev CDN and return their URL and MIME type.
     */
    public function withHostedURL(bool $hostedURL): self
    {
        $self = clone $this;
        $self['hostedURL'] = $hostedURL;

        return $self;
    }

    /**
     * Per-image enrichment timeout in milliseconds. Default: 30000. Maximum: 60000.
     */
    public function withMaxTimePerMs(int $maxTimePerMs): self
    {
        $self = clone $this;
        $self['maxTimePerMs'] = $maxTimePerMs;

        return $self;
    }

    /**
     * Measure image width and height when possible.
     */
    public function withResolution(bool $resolution): self
    {
        $self = clone $this;
        $self['resolution'] = $resolution;

        return $self;
    }
}
