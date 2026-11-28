<?php

declare(strict_types=1);

namespace ContextDev\Batch;

use ContextDev\Batch\CrawlControls\Exclude;
use ContextDev\Batch\CrawlControls\Follow;
use ContextDev\Batch\CrawlControls\Languages;
use ContextDev\Batch\CrawlControls\Languages\UnionMember0;
use ContextDev\Batch\CrawlControls\Scrape;
use ContextDev\Batch\CrawlControls\Source\Sitemap;
use ContextDev\Batch\CrawlControls\Source\StartURL;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Crawl settings as submitted.
 *
 * @phpstan-import-type ExcludeVariants from \ContextDev\Batch\CrawlControls\Exclude
 * @phpstan-import-type FollowVariants from \ContextDev\Batch\CrawlControls\Follow
 * @phpstan-import-type LanguagesVariants from \ContextDev\Batch\CrawlControls\Languages
 * @phpstan-import-type ScrapeVariants from \ContextDev\Batch\CrawlControls\Scrape
 * @phpstan-import-type SourceVariants from \ContextDev\Batch\CrawlControls\Source
 * @phpstan-import-type ExcludeShape from \ContextDev\Batch\CrawlControls\Exclude
 * @phpstan-import-type FollowShape from \ContextDev\Batch\CrawlControls\Follow
 * @phpstan-import-type LanguagesShape from \ContextDev\Batch\CrawlControls\Languages
 * @phpstan-import-type ScrapeShape from \ContextDev\Batch\CrawlControls\Scrape
 * @phpstan-import-type SourceShape from \ContextDev\Batch\CrawlControls\Source
 *
 * @phpstan-type CrawlControlsShape = array{
 *   exclude: list<ExcludeShape>|null,
 *   excludeURLPattern: string|null,
 *   follow: list<FollowShape>|null,
 *   followSubdomains: bool,
 *   languages: LanguagesShape|null,
 *   maxDepth: int|null,
 *   maxPages: int,
 *   scrape: list<ScrapeShape>|null,
 *   source: SourceShape,
 *   urlPattern: string|null,
 * }
 */
final class CrawlControls implements BaseModel
{
    /** @use SdkModel<CrawlControlsShape> */
    use SdkModel;

    /**
     * Matchers for the pages the crawl skipped. `null` when it skipped none.
     *
     * @var list<ExcludeVariants>|null $exclude
     */
    #[Required(list: Exclude::class)]
    public ?array $exclude;

    /**
     * Regex that excluded matching URLs from the crawl. `null` when the crawl set none.
     */
    #[Required('exclude_url_pattern')]
    public ?string $excludeURLPattern;

    /**
     * Matchers for the links the crawl followed. `null` when it followed every link.
     *
     * @var list<FollowVariants>|null $follow
     */
    #[Required(list: Follow::class)]
    public ?array $follow;

    /**
     * Whether links to subdomains were followed. Always `false` for a sitemap crawl.
     */
    #[Required('follow_subdomains')]
    public bool $followSubdomains;

    /**
     * Languages whose pages were followed. `null` when all languages were.
     *
     * @var LanguagesVariants|null $languages
     */
    #[Required(union: Languages::class)]
    public array|string|null $languages;

    /**
     * Maximum link depth. Always `0` for a sitemap crawl; `null` when a `start_url` crawl set no limit.
     */
    #[Required('max_depth')]
    public ?int $maxDepth;

    /**
     * The `maxUrls` submitted with the crawl. A sitemap crawl scrapes only the URLs its sitemap lists, up to this many, so `input.reserved` can be lower.
     */
    #[Required('max_pages')]
    public int $maxPages;

    /**
     * Matchers for the pages the crawl returned. `null` when it returned every fetched page.
     *
     * @var list<ScrapeVariants>|null $scrape
     */
    #[Required(list: Scrape::class)]
    public ?array $scrape;

    /**
     * Where the crawl started.
     *
     * @var SourceVariants $source
     */
    #[Required]
    public StartURL|Sitemap $source;

    /**
     * Regex that URLs had to match to be crawled. `null` when the crawl set none.
     */
    #[Required('url_pattern')]
    public ?string $urlPattern;

    /**
     * `new CrawlControls()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CrawlControls::with(
     *   exclude: ...,
     *   excludeURLPattern: ...,
     *   follow: ...,
     *   followSubdomains: ...,
     *   languages: ...,
     *   maxDepth: ...,
     *   maxPages: ...,
     *   scrape: ...,
     *   source: ...,
     *   urlPattern: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CrawlControls)
     *   ->withExclude(...)
     *   ->withExcludeURLPattern(...)
     *   ->withFollow(...)
     *   ->withFollowSubdomains(...)
     *   ->withLanguages(...)
     *   ->withMaxDepth(...)
     *   ->withMaxPages(...)
     *   ->withScrape(...)
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
     * @param list<ExcludeShape>|null $exclude
     * @param list<FollowShape>|null $follow
     * @param LanguagesShape|null $languages
     * @param list<ScrapeShape>|null $scrape
     * @param SourceShape $source
     */
    public static function with(
        ?array $exclude,
        ?string $excludeURLPattern,
        ?array $follow,
        bool $followSubdomains,
        UnionMember0|array|string|null $languages,
        ?int $maxDepth,
        int $maxPages,
        ?array $scrape,
        StartURL|array|Sitemap $source,
        ?string $urlPattern,
    ): self {
        $self = new self;

        $self['exclude'] = $exclude;
        $self['excludeURLPattern'] = $excludeURLPattern;
        $self['follow'] = $follow;
        $self['followSubdomains'] = $followSubdomains;
        $self['languages'] = $languages;
        $self['maxDepth'] = $maxDepth;
        $self['maxPages'] = $maxPages;
        $self['scrape'] = $scrape;
        $self['source'] = $source;
        $self['urlPattern'] = $urlPattern;

        return $self;
    }

    /**
     * Matchers for the pages the crawl skipped. `null` when it skipped none.
     *
     * @param list<ExcludeShape>|null $exclude
     */
    public function withExclude(?array $exclude): self
    {
        $self = clone $this;
        $self['exclude'] = $exclude;

        return $self;
    }

    /**
     * Regex that excluded matching URLs from the crawl. `null` when the crawl set none.
     */
    public function withExcludeURLPattern(?string $excludeURLPattern): self
    {
        $self = clone $this;
        $self['excludeURLPattern'] = $excludeURLPattern;

        return $self;
    }

    /**
     * Matchers for the links the crawl followed. `null` when it followed every link.
     *
     * @param list<FollowShape>|null $follow
     */
    public function withFollow(?array $follow): self
    {
        $self = clone $this;
        $self['follow'] = $follow;

        return $self;
    }

    /**
     * Whether links to subdomains were followed. Always `false` for a sitemap crawl.
     */
    public function withFollowSubdomains(bool $followSubdomains): self
    {
        $self = clone $this;
        $self['followSubdomains'] = $followSubdomains;

        return $self;
    }

    /**
     * Languages whose pages were followed. `null` when all languages were.
     *
     * @param LanguagesShape|null $languages
     */
    public function withLanguages(
        UnionMember0|array|string|null $languages
    ): self {
        $self = clone $this;
        $self['languages'] = $languages;

        return $self;
    }

    /**
     * Maximum link depth. Always `0` for a sitemap crawl; `null` when a `start_url` crawl set no limit.
     */
    public function withMaxDepth(?int $maxDepth): self
    {
        $self = clone $this;
        $self['maxDepth'] = $maxDepth;

        return $self;
    }

    /**
     * The `maxUrls` submitted with the crawl. A sitemap crawl scrapes only the URLs its sitemap lists, up to this many, so `input.reserved` can be lower.
     */
    public function withMaxPages(int $maxPages): self
    {
        $self = clone $this;
        $self['maxPages'] = $maxPages;

        return $self;
    }

    /**
     * Matchers for the pages the crawl returned. `null` when it returned every fetched page.
     *
     * @param list<ScrapeShape>|null $scrape
     */
    public function withScrape(?array $scrape): self
    {
        $self = clone $this;
        $self['scrape'] = $scrape;

        return $self;
    }

    /**
     * Where the crawl started.
     *
     * @param SourceShape $source
     */
    public function withSource(StartURL|array|Sitemap $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }

    /**
     * Regex that URLs had to match to be crawled. `null` when the crawl set none.
     */
    public function withURLPattern(?string $urlPattern): self
    {
        $self = clone $this;
        $self['urlPattern'] = $urlPattern;

        return $self;
    }
}
