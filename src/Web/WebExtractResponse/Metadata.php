<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type MetadataShape = array{
 *   maxCrawlDepth: int,
 *   numBlocked: int,
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

    #[Required]
    public int $maxCrawlDepth;

    /**
     * Number of crawled pages excluded because they were anti-bot challenges, error pages, or parked-domain placeholders.
     */
    #[Required]
    public int $numBlocked;

    #[Required]
    public int $numFailed;

    #[Required]
    public int $numSkipped;

    #[Required]
    public int $numSucceeded;

    #[Required('numUrls')]
    public int $numURLs;

    /**
     * `new Metadata()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Metadata::with(
     *   maxCrawlDepth: ...,
     *   numBlocked: ...,
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
     *   ->withNumBlocked(...)
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
        int $numBlocked,
        int $numFailed,
        int $numSkipped,
        int $numSucceeded,
        int $numURLs,
    ): self {
        $self = new self;

        $self['maxCrawlDepth'] = $maxCrawlDepth;
        $self['numBlocked'] = $numBlocked;
        $self['numFailed'] = $numFailed;
        $self['numSkipped'] = $numSkipped;
        $self['numSucceeded'] = $numSucceeded;
        $self['numURLs'] = $numURLs;

        return $self;
    }

    public function withMaxCrawlDepth(int $maxCrawlDepth): self
    {
        $self = clone $this;
        $self['maxCrawlDepth'] = $maxCrawlDepth;

        return $self;
    }

    /**
     * Number of crawled pages excluded because they were anti-bot challenges, error pages, or parked-domain placeholders.
     */
    public function withNumBlocked(int $numBlocked): self
    {
        $self = clone $this;
        $self['numBlocked'] = $numBlocked;

        return $self;
    }

    public function withNumFailed(int $numFailed): self
    {
        $self = clone $this;
        $self['numFailed'] = $numFailed;

        return $self;
    }

    public function withNumSkipped(int $numSkipped): self
    {
        $self = clone $this;
        $self['numSkipped'] = $numSkipped;

        return $self;
    }

    public function withNumSucceeded(int $numSucceeded): self
    {
        $self = clone $this;
        $self['numSucceeded'] = $numSucceeded;

        return $self;
    }

    public function withNumURLs(int $numURLs): self
    {
        $self = clone $this;
        $self['numURLs'] = $numURLs;

        return $self;
    }
}
