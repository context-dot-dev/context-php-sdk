<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebCrawlMdResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type MetadataShape = array{
 *   maxCrawlDepth: int,
 *   numFailed: int,
 *   numSkipped: int,
 *   numSucceeded: int,
 *   numURLs: int,
 * }
 */
final class Metadata implements BaseModel
{
    /** @use SdkModel<MetadataShape> */
    use SdkModel;

    /**
     * Maximum crawl depth reached during the crawl.
     */
    #[Required]
    public int $maxCrawlDepth;

    /**
     * Number of pages that failed to crawl.
     */
    #[Required]
    public int $numFailed;

    /**
     * Number of URLs skipped (PDFs when pdf.shouldParse=false, or URLs not matching urlRegex).
     */
    #[Required]
    public int $numSkipped;

    /**
     * Number of pages successfully crawled.
     */
    #[Required]
    public int $numSucceeded;

    /**
     * Total number of URLs crawled.
     */
    #[Required('numUrls')]
    public int $numURLs;

    /**
     * `new Metadata()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Metadata::with(
     *   maxCrawlDepth: ...,
     *   numFailed: ...,
     *   numSkipped: ...,
     *   numSucceeded: ...,
     *   numURLs: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Metadata)
     *   ->withMaxCrawlDepth(...)
     *   ->withNumFailed(...)
     *   ->withNumSkipped(...)
     *   ->withNumSucceeded(...)
     *   ->withNumURLs(...)
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
        int $maxCrawlDepth,
        int $numFailed,
        int $numSkipped,
        int $numSucceeded,
        int $numURLs,
    ): self {
        $self = new self;

        $self['maxCrawlDepth'] = $maxCrawlDepth;
        $self['numFailed'] = $numFailed;
        $self['numSkipped'] = $numSkipped;
        $self['numSucceeded'] = $numSucceeded;
        $self['numURLs'] = $numURLs;

        return $self;
    }

    /**
     * Maximum crawl depth reached during the crawl.
     */
    public function withMaxCrawlDepth(int $maxCrawlDepth): self
    {
        $self = clone $this;
        $self['maxCrawlDepth'] = $maxCrawlDepth;

        return $self;
    }

    /**
     * Number of pages that failed to crawl.
     */
    public function withNumFailed(int $numFailed): self
    {
        $self = clone $this;
        $self['numFailed'] = $numFailed;

        return $self;
    }

    /**
     * Number of URLs skipped (PDFs when pdf.shouldParse=false, or URLs not matching urlRegex).
     */
    public function withNumSkipped(int $numSkipped): self
    {
        $self = clone $this;
        $self['numSkipped'] = $numSkipped;

        return $self;
    }

    /**
     * Number of pages successfully crawled.
     */
    public function withNumSucceeded(int $numSucceeded): self
    {
        $self = clone $this;
        $self['numSucceeded'] = $numSucceeded;

        return $self;
    }

    /**
     * Total number of URLs crawled.
     */
    public function withNumURLs(int $numURLs): self
    {
        $self = clone $this;
        $self['numURLs'] = $numURLs;

        return $self;
    }
}
