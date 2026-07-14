<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeImagesParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebScrapeImagesParams\Enrichment\Classification;
use ContextDev\Web\WebWebScrapeImagesParams\Enrichment\Classification\UnionMember1;
use ContextDev\Web\WebWebScrapeImagesParams\Enrichment\HostedURL;
use ContextDev\Web\WebWebScrapeImagesParams\Enrichment\Resolution;

/**
 * Optional per-image processing, sent as deep-object query params such as enrichment[resolution]=true.
 *
 * @phpstan-import-type ClassificationVariants from \ContextDev\Web\WebWebScrapeImagesParams\Enrichment\Classification
 * @phpstan-import-type HostedURLVariants from \ContextDev\Web\WebWebScrapeImagesParams\Enrichment\HostedURL
 * @phpstan-import-type ResolutionVariants from \ContextDev\Web\WebWebScrapeImagesParams\Enrichment\Resolution
 * @phpstan-import-type ClassificationShape from \ContextDev\Web\WebWebScrapeImagesParams\Enrichment\Classification
 * @phpstan-import-type HostedURLShape from \ContextDev\Web\WebWebScrapeImagesParams\Enrichment\HostedURL
 * @phpstan-import-type ResolutionShape from \ContextDev\Web\WebWebScrapeImagesParams\Enrichment\Resolution
 *
 * @phpstan-type EnrichmentShape = array{
 *   classification?: ClassificationShape|null,
 *   hostedURL?: HostedURLShape|null,
 *   maxTimePerMs?: int|null,
 *   resolution?: ResolutionShape|null,
 * }
 */
final class Enrichment implements BaseModel
{
    /** @use SdkModel<EnrichmentShape> */
    use SdkModel;

    /**
     * Classify each image by visual asset type.
     *
     * @var ClassificationVariants|null $classification
     */
    #[Optional(union: Classification::class)]
    public bool|string|null $classification;

    /**
     * Host materializable images on the Brand.dev CDN and return their URL and MIME type.
     *
     * @var HostedURLVariants|null $hostedURL
     */
    #[Optional('hostedUrl', union: HostedURL::class)]
    public bool|string|null $hostedURL;

    /**
     * Per-image enrichment timeout in milliseconds. Default: 30000. Maximum: 60000.
     */
    #[Optional]
    public ?int $maxTimePerMs;

    /**
     * Measure image width and height when possible.
     *
     * @var ResolutionVariants|null $resolution
     */
    #[Optional(union: Resolution::class)]
    public bool|string|null $resolution;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param ClassificationShape|null $classification
     * @param HostedURLShape|null $hostedURL
     * @param ResolutionShape|null $resolution
     */
    public static function with(
        bool|UnionMember1|string|null $classification = null,
        bool|HostedURL\UnionMember1|string|null $hostedURL = null,
        ?int $maxTimePerMs = null,
        bool|Resolution\UnionMember1|string|null $resolution = null,
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
     *
     * @param ClassificationShape $classification
     */
    public function withClassification(
        bool|UnionMember1|string $classification
    ): self {
        $self = clone $this;
        $self['classification'] = $classification;

        return $self;
    }

    /**
     * Host materializable images on the Brand.dev CDN and return their URL and MIME type.
     *
     * @param HostedURLShape $hostedURL
     */
    public function withHostedURL(
        bool|HostedURL\UnionMember1|string $hostedURL,
    ): self {
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
     *
     * @param ResolutionShape $resolution
     */
    public function withResolution(
        bool|Resolution\UnionMember1|string $resolution,
    ): self {
        $self = clone $this;
        $self['resolution'] = $resolution;

        return $self;
    }
}
