<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeSitemapResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Metadata about the sitemap crawl operation.
 *
 * @phpstan-type MetaShape = array{
 *   errors: int,
 *   sitemapsDiscovered: int,
 *   sitemapsFetched: int,
 *   sitemapsSkipped: int,
 * }
 */
final class Meta implements BaseModel
{
    /** @use SdkModel<MetaShape> */
    use SdkModel;

    /**
     * Number of errors encountered during crawling.
     */
    #[Required]
    public int $errors;

    /**
     * Total number of sitemap files discovered.
     */
    #[Required]
    public int $sitemapsDiscovered;

    /**
     * Number of sitemap files successfully fetched and parsed.
     */
    #[Required]
    public int $sitemapsFetched;

    /**
     * Number of sitemap files skipped (due to errors, timeouts, or limits).
     */
    #[Required]
    public int $sitemapsSkipped;

    /**
     * `new Meta()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Meta::with(
     *   errors: ...,
     *   sitemapsDiscovered: ...,
     *   sitemapsFetched: ...,
     *   sitemapsSkipped: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Meta)
     *   ->withErrors(...)
     *   ->withSitemapsDiscovered(...)
     *   ->withSitemapsFetched(...)
     *   ->withSitemapsSkipped(...)
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
        int $errors,
        int $sitemapsDiscovered,
        int $sitemapsFetched,
        int $sitemapsSkipped,
    ): self {
        $self = new self;

        $self['errors'] = $errors;
        $self['sitemapsDiscovered'] = $sitemapsDiscovered;
        $self['sitemapsFetched'] = $sitemapsFetched;
        $self['sitemapsSkipped'] = $sitemapsSkipped;

        return $self;
    }

    /**
     * Number of errors encountered during crawling.
     */
    public function withErrors(int $errors): self
    {
        $self = clone $this;
        $self['errors'] = $errors;

        return $self;
    }

    /**
     * Total number of sitemap files discovered.
     */
    public function withSitemapsDiscovered(int $sitemapsDiscovered): self
    {
        $self = clone $this;
        $self['sitemapsDiscovered'] = $sitemapsDiscovered;

        return $self;
    }

    /**
     * Number of sitemap files successfully fetched and parsed.
     */
    public function withSitemapsFetched(int $sitemapsFetched): self
    {
        $self = clone $this;
        $self['sitemapsFetched'] = $sitemapsFetched;

        return $self;
    }

    /**
     * Number of sitemap files skipped (due to errors, timeouts, or limits).
     */
    public function withSitemapsSkipped(int $sitemapsSkipped): self
    {
        $self = clone $this;
        $self['sitemapsSkipped'] = $sitemapsSkipped;

        return $self;
    }
}
