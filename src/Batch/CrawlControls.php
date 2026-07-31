<?php

declare(strict_types=1);

namespace ContextDev\Batch;

use ContextDev\Batch\CrawlControls\Source\UnionMember0;
use ContextDev\Batch\CrawlControls\Source\UnionMember1;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * The crawl controls as submitted, so the limits requested can be compared against what the crawl reached.
 *
 * @phpstan-import-type SourceVariants from \ContextDev\Batch\CrawlControls\Source
 * @phpstan-import-type SourceShape from \ContextDev\Batch\CrawlControls\Source
 *
 * @phpstan-type CrawlControlsShape = array{
 *   followSubdomains: bool,
 *   maxDepth: int|null,
 *   maxPages: int,
 *   source: SourceShape,
 *   urlPattern: string|null,
 * }
 */
final class CrawlControls implements BaseModel
{
    /** @use SdkModel<CrawlControlsShape> */
    use SdkModel;

    /**
     * Whether links to subdomains were followed. Always false for a sitemap crawl.
     */
    #[Required('follow_subdomains')]
    public bool $followSubdomains;

    /**
     * Link depth limit. Always 0 for a sitemap crawl, which never follows links off its URLs; null when a `start_url` crawl set no limit.
     */
    #[Required('max_depth')]
    public ?int $maxDepth;

    /**
     * The `maxUrls` submitted with the crawl. A sitemap crawl scrapes only the URLs its sitemap actually lists, up to this many, so `input.reserved` is often lower.
     */
    #[Required('max_pages')]
    public int $maxPages;

    /**
     * Where the crawl started.
     *
     * @var SourceVariants $source
     */
    #[Required]
    public UnionMember0|UnionMember1 $source;

    /**
     * RE2 pattern URLs had to match to be crawled. Null when the crawl set none.
     */
    #[Required('url_pattern')]
    public ?string $urlPattern;

    /**
     * `new CrawlControls()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CrawlControls::with(
     *   followSubdomains: ...,
     *   maxDepth: ...,
     *   maxPages: ...,
     *   source: ...,
     *   urlPattern: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CrawlControls)
     *   ->withFollowSubdomains(...)
     *   ->withMaxDepth(...)
     *   ->withMaxPages(...)
     *   ->withSource(...)
     *   ->withURLPattern(...)
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
     * @param SourceShape $source
     */
    public static function with(
        bool $followSubdomains,
        ?int $maxDepth,
        int $maxPages,
        UnionMember0|array|UnionMember1 $source,
        ?string $urlPattern,
    ): self {
        $self = new self;

        $self['followSubdomains'] = $followSubdomains;
        $self['maxDepth'] = $maxDepth;
        $self['maxPages'] = $maxPages;
        $self['source'] = $source;
        $self['urlPattern'] = $urlPattern;

        return $self;
    }

    /**
     * Whether links to subdomains were followed. Always false for a sitemap crawl.
     */
    public function withFollowSubdomains(bool $followSubdomains): self
    {
        $self = clone $this;
        $self['followSubdomains'] = $followSubdomains;

        return $self;
    }

    /**
     * Link depth limit. Always 0 for a sitemap crawl, which never follows links off its URLs; null when a `start_url` crawl set no limit.
     */
    public function withMaxDepth(?int $maxDepth): self
    {
        $self = clone $this;
        $self['maxDepth'] = $maxDepth;

        return $self;
    }

    /**
     * The `maxUrls` submitted with the crawl. A sitemap crawl scrapes only the URLs its sitemap actually lists, up to this many, so `input.reserved` is often lower.
     */
    public function withMaxPages(int $maxPages): self
    {
        $self = clone $this;
        $self['maxPages'] = $maxPages;

        return $self;
    }

    /**
     * Where the crawl started.
     *
     * @param SourceShape $source
     */
    public function withSource(UnionMember0|array|UnionMember1 $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }

    /**
     * RE2 pattern URLs had to match to be crawled. Null when the crawl set none.
     */
    public function withURLPattern(?string $urlPattern): self
    {
        $self = clone $this;
        $self['urlPattern'] = $urlPattern;

        return $self;
    }
}
