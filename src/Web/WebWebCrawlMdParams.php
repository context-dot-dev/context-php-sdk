<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebCrawlMdParams\Country;
use ContextDev\Web\WebWebCrawlMdParams\IncludeFrames;
use ContextDev\Web\WebWebCrawlMdParams\IncludeFrames\UnionMember1;
use ContextDev\Web\WebWebCrawlMdParams\Pdf;
use ContextDev\Web\WebWebCrawlMdParams\SourcePreference;
use ContextDev\Web\WebWebCrawlMdParams\TimeoutOpts;
use ContextDev\Web\WebWebCrawlMdParams\Zdr;

/**
 * Crawl up to 500 pages from a start URL and get each page back as Markdown with metadata. Control scope with depth limits, regex patterns, and subdomain rules. For larger crawls, use a batch.
 *
 * @see ContextDev\Services\WebService::webCrawlMd()
 *
 * @phpstan-import-type IncludeFramesVariants from \ContextDev\Web\WebWebCrawlMdParams\IncludeFrames
 * @phpstan-import-type IncludeFramesShape from \ContextDev\Web\WebWebCrawlMdParams\IncludeFrames
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebWebCrawlMdParams\Pdf
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebWebCrawlMdParams\TimeoutOpts
 *
 * @phpstan-type WebWebCrawlMdParamsShape = array{
 *   url: string,
 *   country?: null|Country|value-of<Country>,
 *   excludeSelectors?: list<string>|null,
 *   excludeURLRegex?: string|null,
 *   followSubdomains?: bool|null,
 *   includeFrames?: IncludeFramesShape|null,
 *   includeImages?: bool|null,
 *   includeLinks?: bool|null,
 *   includeSelectors?: list<string>|null,
 *   maxAgeMs?: int|null,
 *   maxDepth?: int|null,
 *   maxPages?: int|null,
 *   pdf?: null|Pdf|PdfShape,
 *   policies?: list<string>|null,
 *   settleAnimations?: bool|null,
 *   shortenBase64Images?: bool|null,
 *   sourcePreference?: list<SourcePreference|value-of<SourcePreference>>|null,
 *   stopAfterMs?: int|null,
 *   tags?: list<string>|null,
 *   timeoutOpts?: null|TimeoutOpts|TimeoutOptsShape,
 *   urlRegex?: string|null,
 *   useMainContentOnly?: bool|null,
 *   waitForMs?: int|null,
 *   zdr?: null|Zdr|value-of<Zdr>,
 * }
 */
final class WebWebCrawlMdParams implements BaseModel
{
    /** @use SdkModel<WebWebCrawlMdParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Start URL, including `http://` or `https://`.
     */
    #[Required]
    public string $url;

    /**
     * Country to fetch from, as an ISO 3166-1 alpha-2 code.
     *
     * @var value-of<Country>|null $country
     */
    #[Optional(enum: Country::class)]
    public ?string $country;

    /**
     * Remove elements matching these CSS selectors. Overrides `includeSelectors`.
     *
     * @var list<string>|null $excludeSelectors
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $excludeSelectors;

    /**
     * Never follow or scrape URLs matching this regex, even when they match `urlRegex`. The start URL is always scraped.
     */
    #[Optional('excludeUrlRegex')]
    public ?string $excludeURLRegex;

    /**
     * Follow links to subdomains of the start URL's domain, such as `docs.example.com` from `example.com`. `www` and the apex domain always count as the same site.
     */
    #[Optional]
    public ?bool $followSubdomains;

    /**
     * Which iframe contents to include in each page's Markdown. `auto` inlines only iframes that hold page content, such as same-site documents, framesets, job boards, forms, and embedded documents, and skips ads and widgets. `true` inlines every iframe; `false` inlines none.
     *
     * @var IncludeFramesVariants|null $includeFrames
     */
    #[Optional(union: IncludeFrames::class)]
    public bool|string|null $includeFrames;

    /**
     * Include image references in the Markdown (`html-conversion` only).
     */
    #[Optional]
    public ?bool $includeImages;

    /**
     * Keep link URLs in the Markdown (`html-conversion` only).
     */
    #[Optional]
    public ?bool $includeLinks;

    /**
     * Keep only elements matching these CSS selectors.
     *
     * @var list<string>|null $includeSelectors
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $includeSelectors;

    /**
     * Maximum age of a cached result, in milliseconds. `0` always fetches fresh. Defaults to 1 day (86400000 ms). Maximum: 30 days (2592000000 ms).
     */
    #[Optional(nullable: true)]
    public ?int $maxAgeMs;

    /**
     * Maximum link depth from the start URL. `0` crawls only the start URL. Omit for no depth limit.
     */
    #[Optional]
    public ?int $maxDepth;

    /**
     * Maximum number of pages to crawl.
     */
    #[Optional]
    public ?int $maxPages;

    /**
     * Whether to parse PDFs and which pages to read.
     */
    #[Optional]
    public ?Pdf $pdf;

    /**
     * Access policy IDs to apply; each URL must pass all of them. Requires access policies enabled for your organization; otherwise returns `ACCESS_POLICIES_NOT_ENABLED`.
     *
     * @var list<string>|null $policies
     */
    #[Optional(list: 'string')]
    public ?array $policies;

    /**
     * Wait briefly for CSS animations and transitions to settle before reading each page.
     */
    #[Optional]
    public ?bool $settleAnimations;

    /**
     * Shorten inline base64 image data (`html-conversion` only).
     */
    #[Optional]
    public ?bool $shortenBase64Images;

    /**
     * Markdown sources in order of preference: `html-conversion` converts the page HTML, `markdown-direct` uses Markdown the site publishes.
     *
     * @var list<value-of<SourcePreference>>|null $sourcePreference
     */
    #[Optional(list: SourcePreference::class)]
    public ?array $sourcePreference;

    /**
     * Soft time budget for the crawl, in milliseconds. When it runs out, the crawl returns the pages collected so far. Larger values are capped at 110 seconds.
     */
    #[Optional]
    public ?int $stopAfterMs;

    /**
     * Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Request deadline and what to return when it passes.
     */
    #[Optional]
    public ?TimeoutOpts $timeoutOpts;

    /**
     * Only follow and scrape URLs matching this regex. A prefix pattern of the form `^<start URL>` also follows a redirect of the start page.
     */
    #[Optional]
    public ?string $urlRegex;

    /**
     * Keep only the main content, without navigation, headers, footers, or sidebars.
     */
    #[Optional]
    public ?bool $useMainContentOnly;

    /**
     * Time to wait after each page loads before reading it, in milliseconds. `0` waits 500 ms. `timeoutOpts.milliseconds` must be at least `waitForMs` plus 10000 ms, or the request fails with `TIMEOUT_TOO_SHORT_FOR_WAIT`.
     */
    #[Optional(nullable: true)]
    public ?int $waitForMs;

    /**
     * `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     *
     * @var value-of<Zdr>|null $zdr
     */
    #[Optional(enum: Zdr::class)]
    public ?string $zdr;

    /**
     * `new WebWebCrawlMdParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebWebCrawlMdParams::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebWebCrawlMdParams)->withURL(...)
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
     * @param Country|value-of<Country>|null $country
     * @param list<string>|null $excludeSelectors
     * @param IncludeFramesShape|null $includeFrames
     * @param list<string>|null $includeSelectors
     * @param Pdf|PdfShape|null $pdf
     * @param list<string>|null $policies
     * @param list<SourcePreference|value-of<SourcePreference>>|null $sourcePreference
     * @param list<string>|null $tags
     * @param TimeoutOpts|TimeoutOptsShape|null $timeoutOpts
     * @param Zdr|value-of<Zdr>|null $zdr
     */
    public static function with(
        string $url,
        Country|string|null $country = null,
        ?array $excludeSelectors = null,
        ?string $excludeURLRegex = null,
        ?bool $followSubdomains = null,
        bool|UnionMember1|string|null $includeFrames = null,
        ?bool $includeImages = null,
        ?bool $includeLinks = null,
        ?array $includeSelectors = null,
        ?int $maxAgeMs = null,
        ?int $maxDepth = null,
        ?int $maxPages = null,
        Pdf|array|null $pdf = null,
        ?array $policies = null,
        ?bool $settleAnimations = null,
        ?bool $shortenBase64Images = null,
        ?array $sourcePreference = null,
        ?int $stopAfterMs = null,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
        ?string $urlRegex = null,
        ?bool $useMainContentOnly = null,
        ?int $waitForMs = null,
        Zdr|string|null $zdr = null,
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $country && $self['country'] = $country;
        null !== $excludeSelectors && $self['excludeSelectors'] = $excludeSelectors;
        null !== $excludeURLRegex && $self['excludeURLRegex'] = $excludeURLRegex;
        null !== $followSubdomains && $self['followSubdomains'] = $followSubdomains;
        null !== $includeFrames && $self['includeFrames'] = $includeFrames;
        null !== $includeImages && $self['includeImages'] = $includeImages;
        null !== $includeLinks && $self['includeLinks'] = $includeLinks;
        null !== $includeSelectors && $self['includeSelectors'] = $includeSelectors;
        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
        null !== $maxDepth && $self['maxDepth'] = $maxDepth;
        null !== $maxPages && $self['maxPages'] = $maxPages;
        null !== $pdf && $self['pdf'] = $pdf;
        null !== $policies && $self['policies'] = $policies;
        null !== $settleAnimations && $self['settleAnimations'] = $settleAnimations;
        null !== $shortenBase64Images && $self['shortenBase64Images'] = $shortenBase64Images;
        null !== $sourcePreference && $self['sourcePreference'] = $sourcePreference;
        null !== $stopAfterMs && $self['stopAfterMs'] = $stopAfterMs;
        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutOpts && $self['timeoutOpts'] = $timeoutOpts;
        null !== $urlRegex && $self['urlRegex'] = $urlRegex;
        null !== $useMainContentOnly && $self['useMainContentOnly'] = $useMainContentOnly;
        null !== $waitForMs && $self['waitForMs'] = $waitForMs;
        null !== $zdr && $self['zdr'] = $zdr;

        return $self;
    }

    /**
     * Start URL, including `http://` or `https://`.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Country to fetch from, as an ISO 3166-1 alpha-2 code.
     *
     * @param Country|value-of<Country> $country
     */
    public function withCountry(Country|string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * Remove elements matching these CSS selectors. Overrides `includeSelectors`.
     *
     * @param list<string>|null $excludeSelectors
     */
    public function withExcludeSelectors(?array $excludeSelectors): self
    {
        $self = clone $this;
        $self['excludeSelectors'] = $excludeSelectors;

        return $self;
    }

    /**
     * Never follow or scrape URLs matching this regex, even when they match `urlRegex`. The start URL is always scraped.
     */
    public function withExcludeURLRegex(string $excludeURLRegex): self
    {
        $self = clone $this;
        $self['excludeURLRegex'] = $excludeURLRegex;

        return $self;
    }

    /**
     * Follow links to subdomains of the start URL's domain, such as `docs.example.com` from `example.com`. `www` and the apex domain always count as the same site.
     */
    public function withFollowSubdomains(bool $followSubdomains): self
    {
        $self = clone $this;
        $self['followSubdomains'] = $followSubdomains;

        return $self;
    }

    /**
     * Which iframe contents to include in each page's Markdown. `auto` inlines only iframes that hold page content, such as same-site documents, framesets, job boards, forms, and embedded documents, and skips ads and widgets. `true` inlines every iframe; `false` inlines none.
     *
     * @param IncludeFramesShape $includeFrames
     */
    public function withIncludeFrames(
        bool|UnionMember1|string $includeFrames
    ): self {
        $self = clone $this;
        $self['includeFrames'] = $includeFrames;

        return $self;
    }

    /**
     * Include image references in the Markdown (`html-conversion` only).
     */
    public function withIncludeImages(bool $includeImages): self
    {
        $self = clone $this;
        $self['includeImages'] = $includeImages;

        return $self;
    }

    /**
     * Keep link URLs in the Markdown (`html-conversion` only).
     */
    public function withIncludeLinks(bool $includeLinks): self
    {
        $self = clone $this;
        $self['includeLinks'] = $includeLinks;

        return $self;
    }

    /**
     * Keep only elements matching these CSS selectors.
     *
     * @param list<string>|null $includeSelectors
     */
    public function withIncludeSelectors(?array $includeSelectors): self
    {
        $self = clone $this;
        $self['includeSelectors'] = $includeSelectors;

        return $self;
    }

    /**
     * Maximum age of a cached result, in milliseconds. `0` always fetches fresh. Defaults to 1 day (86400000 ms). Maximum: 30 days (2592000000 ms).
     */
    public function withMaxAgeMs(?int $maxAgeMs): self
    {
        $self = clone $this;
        $self['maxAgeMs'] = $maxAgeMs;

        return $self;
    }

    /**
     * Maximum link depth from the start URL. `0` crawls only the start URL. Omit for no depth limit.
     */
    public function withMaxDepth(int $maxDepth): self
    {
        $self = clone $this;
        $self['maxDepth'] = $maxDepth;

        return $self;
    }

    /**
     * Maximum number of pages to crawl.
     */
    public function withMaxPages(int $maxPages): self
    {
        $self = clone $this;
        $self['maxPages'] = $maxPages;

        return $self;
    }

    /**
     * Whether to parse PDFs and which pages to read.
     *
     * @param Pdf|PdfShape $pdf
     */
    public function withPdf(Pdf|array $pdf): self
    {
        $self = clone $this;
        $self['pdf'] = $pdf;

        return $self;
    }

    /**
     * Access policy IDs to apply; each URL must pass all of them. Requires access policies enabled for your organization; otherwise returns `ACCESS_POLICIES_NOT_ENABLED`.
     *
     * @param list<string> $policies
     */
    public function withPolicies(array $policies): self
    {
        $self = clone $this;
        $self['policies'] = $policies;

        return $self;
    }

    /**
     * Wait briefly for CSS animations and transitions to settle before reading each page.
     */
    public function withSettleAnimations(bool $settleAnimations): self
    {
        $self = clone $this;
        $self['settleAnimations'] = $settleAnimations;

        return $self;
    }

    /**
     * Shorten inline base64 image data (`html-conversion` only).
     */
    public function withShortenBase64Images(bool $shortenBase64Images): self
    {
        $self = clone $this;
        $self['shortenBase64Images'] = $shortenBase64Images;

        return $self;
    }

    /**
     * Markdown sources in order of preference: `html-conversion` converts the page HTML, `markdown-direct` uses Markdown the site publishes.
     *
     * @param list<SourcePreference|value-of<SourcePreference>> $sourcePreference
     */
    public function withSourcePreference(array $sourcePreference): self
    {
        $self = clone $this;
        $self['sourcePreference'] = $sourcePreference;

        return $self;
    }

    /**
     * Soft time budget for the crawl, in milliseconds. When it runs out, the crawl returns the pages collected so far. Larger values are capped at 110 seconds.
     */
    public function withStopAfterMs(int $stopAfterMs): self
    {
        $self = clone $this;
        $self['stopAfterMs'] = $stopAfterMs;

        return $self;
    }

    /**
     * Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
     *
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * Request deadline and what to return when it passes.
     *
     * @param TimeoutOpts|TimeoutOptsShape $timeoutOpts
     */
    public function withTimeoutOpts(TimeoutOpts|array $timeoutOpts): self
    {
        $self = clone $this;
        $self['timeoutOpts'] = $timeoutOpts;

        return $self;
    }

    /**
     * Only follow and scrape URLs matching this regex. A prefix pattern of the form `^<start URL>` also follows a redirect of the start page.
     */
    public function withURLRegex(string $urlRegex): self
    {
        $self = clone $this;
        $self['urlRegex'] = $urlRegex;

        return $self;
    }

    /**
     * Keep only the main content, without navigation, headers, footers, or sidebars.
     */
    public function withUseMainContentOnly(bool $useMainContentOnly): self
    {
        $self = clone $this;
        $self['useMainContentOnly'] = $useMainContentOnly;

        return $self;
    }

    /**
     * Time to wait after each page loads before reading it, in milliseconds. `0` waits 500 ms. `timeoutOpts.milliseconds` must be at least `waitForMs` plus 10000 ms, or the request fails with `TIMEOUT_TOO_SHORT_FOR_WAIT`.
     */
    public function withWaitForMs(?int $waitForMs): self
    {
        $self = clone $this;
        $self['waitForMs'] = $waitForMs;

        return $self;
    }

    /**
     * `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     *
     * @param Zdr|value-of<Zdr> $zdr
     */
    public function withZdr(Zdr|string $zdr): self
    {
        $self = clone $this;
        $self['zdr'] = $zdr;

        return $self;
    }
}
