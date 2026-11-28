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
     * Deepest link depth reached.
     */
    #[Required]
    public int $maxCrawlDepth;

    /**
     * Number of pages that failed.
     */
    #[Required]
    public int $numFailed;

    /**
     * Number of URLs skipped: PDFs when `pdf.shouldParse` is `false`, URLs that do not match `urlRegex`, and URLs that match `excludeUrlRegex`.
     */
    #[Required]
    public int $numSkipped;

    /**
     * Number of pages crawled successfully.
     */
    #[Required]
    public int $numSucceeded;

    /**
     * Number of URLs crawled.
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
     * Deepest link depth reached.
     */
    public function withMaxCrawlDepth(int $maxCrawlDepth): self
    {
        $self = clone $this;
        $self['maxCrawlDepth'] = $maxCrawlDepth;

        return $self;
    }

    /**
     * Number of pages that failed.
     */
    public function withNumFailed(int $numFailed): self
    {
        $self = clone $this;
        $self['numFailed'] = $numFailed;

        return $self;
    }

    /**
     * Number of URLs skipped: PDFs when `pdf.shouldParse` is `false`, URLs that do not match `urlRegex`, and URLs that match `excludeUrlRegex`.
     */
    public function withNumSkipped(int $numSkipped): self
    {
        $self = clone $this;
        $self['numSkipped'] = $numSkipped;

        return $self;
    }

    /**
     * Number of pages crawled successfully.
     */
    public function withNumSucceeded(int $numSucceeded): self
    {
        $self = clone $this;
        $self['numSucceeded'] = $numSucceeded;

        return $self;
    }

    /**
     * Number of URLs crawled.
     */
    public function withNumURLs(int $numURLs): self
    {
        $self = clone $this;
        $self['numURLs'] = $numURLs;

        return $self;
    }
}
