<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\Sitemap;

use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\Sitemap\Controls\Exclude;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\Sitemap\Controls\Scrape;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Limits and filters for the sitemap URLs. A sitemap batch scrapes exactly those URLs and never follows links off them, so there is no crawl depth here.
 *
 * @phpstan-import-type ExcludeVariants from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\Sitemap\Controls\Exclude
 * @phpstan-import-type ScrapeVariants from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\Sitemap\Controls\Scrape
 * @phpstan-import-type ExcludeShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\Sitemap\Controls\Exclude
 * @phpstan-import-type ScrapeShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\Sitemap\Controls\Scrape
 *
 * @phpstan-type ControlsShape = array{
 *   exclude?: list<ExcludeShape>|null,
 *   excludePaths?: list<string>|null,
 *   maxURLs?: int|null,
 *   scrape?: list<ScrapeShape>|null,
 * }
 */
final class Controls implements BaseModel
{
    /** @use SdkModel<ControlsShape> */
    use SdkModel;

    /**
     * Sitemap pages to skip, even when they match `scrape`.
     *
     * @var list<ExcludeVariants>|null $exclude
     */
    #[Optional(list: Exclude::class)]
    public ?array $exclude;

    /**
     * Path fragments that skip a sitemap URL in a crawl. Works separately from `scrape` and `exclude`. Defaults to ["/feed","/rss","/atom","/api/","/cdn-cgi/","/_next/","/__"]. Pass `[]` to keep every listed URL.
     *
     * @var list<string>|null $excludePaths
     */
    #[Optional(list: 'string')]
    public ?array $excludePaths;

    /**
     * Maximum pages to fetch. Unused reserved credits are refunded. Maximum 100000.
     */
    #[Optional('maxUrls')]
    public ?int $maxURLs;

    /**
     * Sitemap pages to return in the results. Returns every listed page when omitted.
     *
     * @var list<ScrapeVariants>|null $scrape
     */
    #[Optional(list: Scrape::class)]
    public ?array $scrape;

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
     * @param list<string>|null $excludePaths
     * @param list<ScrapeShape>|null $scrape
     */
    public static function with(
        ?array $exclude = null,
        ?array $excludePaths = null,
        ?int $maxURLs = null,
        ?array $scrape = null,
    ): self {
        $self = new self;

        null !== $exclude && $self['exclude'] = $exclude;
        null !== $excludePaths && $self['excludePaths'] = $excludePaths;
        null !== $maxURLs && $self['maxURLs'] = $maxURLs;
        null !== $scrape && $self['scrape'] = $scrape;

        return $self;
    }

    /**
     * Sitemap pages to skip, even when they match `scrape`.
     *
     * @param list<ExcludeShape> $exclude
     */
    public function withExclude(array $exclude): self
    {
        $self = clone $this;
        $self['exclude'] = $exclude;

        return $self;
    }

    /**
     * Path fragments that skip a sitemap URL in a crawl. Works separately from `scrape` and `exclude`. Defaults to ["/feed","/rss","/atom","/api/","/cdn-cgi/","/_next/","/__"]. Pass `[]` to keep every listed URL.
     *
     * @param list<string> $excludePaths
     */
    public function withExcludePaths(array $excludePaths): self
    {
        $self = clone $this;
        $self['excludePaths'] = $excludePaths;

        return $self;
    }

    /**
     * Maximum pages to fetch. Unused reserved credits are refunded. Maximum 100000.
     */
    public function withMaxURLs(int $maxURLs): self
    {
        $self = clone $this;
        $self['maxURLs'] = $maxURLs;

        return $self;
    }

    /**
     * Sitemap pages to return in the results. Returns every listed page when omitted.
     *
     * @param list<ScrapeShape> $scrape
     */
    public function withScrape(array $scrape): self
    {
        $self = clone $this;
        $self['scrape'] = $scrape;

        return $self;
    }
}
