<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebCrawlMdParams\Country;
use ContextDev\Web\WebWebCrawlMdParams\Pdf;
use ContextDev\Web\WebWebCrawlMdParams\TimeoutOpts;
use ContextDev\Web\WebWebCrawlMdParams\Zdr;

/**
 * Crawl a website and return page content as Markdown. Use a batch for crawls beyond 500 pages.
 *
 * @see ContextDev\Services\WebService::webCrawlMd()
 *
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebWebCrawlMdParams\Pdf
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebWebCrawlMdParams\TimeoutOpts
 *
 * @phpstan-type WebWebCrawlMdParamsShape = array{
 *   url: string,
 *   country?: null|Country|value-of<Country>,
 *   excludeSelectors?: list<string>|null,
 *   followSubdomains?: bool|null,
 *   includeFrames?: bool|null,
 *   includeImages?: bool|null,
 *   includeLinks?: bool|null,
 *   includeSelectors?: list<string>|null,
 *   maxAgeMs?: int|null,
 *   maxDepth?: int|null,
 *   maxPages?: int|null,
 *   pdf?: null|Pdf|PdfShape,
 *   settleAnimations?: bool|null,
 *   shortenBase64Images?: bool|null,
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
     * Fetch from this country (ISO 3166-1 alpha-2).
     *
     * @var value-of<Country>|null $country
     */
    #[Optional(enum: Country::class)]
    public ?string $country;

    /**
     * Remove matching elements after inclusions. Exclusions take precedence.
     *
     * @var list<string>|null $excludeSelectors
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $excludeSelectors;

    /**
     * When true, follow links on subdomains of the starting URL's domain (e.g. docs.example.com when starting from example.com). www and apex are always treated as equivalent.
     */
    #[Optional]
    public ?bool $followSubdomains;

    /**
     * When true, the contents of iframes are rendered to Markdown for each crawled page.
     */
    #[Optional]
    public ?bool $includeFrames;

    /**
     * Include image references in the Markdown output.
     */
    #[Optional]
    public ?bool $includeImages;

    /**
     * Preserve hyperlinks in the Markdown output.
     */
    #[Optional]
    public ?bool $includeLinks;

    /**
     * Keep matching HTML subtrees before converting each page to Markdown.
     *
     * @var list<string>|null $includeSelectors
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $includeSelectors;

    /**
     * Maximum cache age in milliseconds. Defaults to 1 day; `0` fetches fresh.
     */
    #[Optional(nullable: true)]
    public ?int $maxAgeMs;

    /**
     * Maximum link depth from the starting URL (0 = only the starting page).
     */
    #[Optional]
    public ?int $maxDepth;

    /**
     * Maximum pages to crawl.
     */
    #[Optional]
    public ?int $maxPages;

    /**
     * PDF handling. `start`/`end` limit parsing to an inclusive, 1-based page range.
     */
    #[Optional]
    public ?Pdf $pdf;

    /**
     * Wait briefly for CSS animations and transitions to settle before reading each page.
     */
    #[Optional]
    public ?bool $settleAnimations;

    /**
     * Truncate base64-encoded image data in the Markdown output.
     */
    #[Optional]
    public ?bool $shortenBase64Images;

    /**
     * Soft crawl deadline in milliseconds. Returns pages collected before the next deadline check.
     */
    #[Optional]
    public ?int $stopAfterMs;

    /**
     * Labels for filtering usage in the dashboard.
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
     * Regex pattern. Only URLs matching this pattern will be followed and scraped. An automatic prefix scope in the form ^<starting URL> follows a redirect of the starting page.
     */
    #[Optional]
    public ?string $urlRegex;

    /**
     * Extract only the main content, stripping headers, footers, sidebars, and navigation.
     */
    #[Optional]
    public ?bool $useMainContentOnly;

    /**
     * Browser wait time in milliseconds after initial page load for each crawled page. Defaults to 3500 (3.5 seconds). Min: 0. Max: 30000 (30 seconds).
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
     * @param list<string>|null $includeSelectors
     * @param Pdf|PdfShape|null $pdf
     * @param list<string>|null $tags
     * @param TimeoutOpts|TimeoutOptsShape|null $timeoutOpts
     * @param Zdr|value-of<Zdr>|null $zdr
     */
    public static function with(
        string $url,
        Country|string|null $country = null,
        ?array $excludeSelectors = null,
        ?bool $followSubdomains = null,
        ?bool $includeFrames = null,
        ?bool $includeImages = null,
        ?bool $includeLinks = null,
        ?array $includeSelectors = null,
        ?int $maxAgeMs = null,
        ?int $maxDepth = null,
        ?int $maxPages = null,
        Pdf|array|null $pdf = null,
        ?bool $settleAnimations = null,
        ?bool $shortenBase64Images = null,
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
        null !== $followSubdomains && $self['followSubdomains'] = $followSubdomains;
        null !== $includeFrames && $self['includeFrames'] = $includeFrames;
        null !== $includeImages && $self['includeImages'] = $includeImages;
        null !== $includeLinks && $self['includeLinks'] = $includeLinks;
        null !== $includeSelectors && $self['includeSelectors'] = $includeSelectors;
        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
        null !== $maxDepth && $self['maxDepth'] = $maxDepth;
        null !== $maxPages && $self['maxPages'] = $maxPages;
        null !== $pdf && $self['pdf'] = $pdf;
        null !== $settleAnimations && $self['settleAnimations'] = $settleAnimations;
        null !== $shortenBase64Images && $self['shortenBase64Images'] = $shortenBase64Images;
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
     * Fetch from this country (ISO 3166-1 alpha-2).
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
     * Remove matching elements after inclusions. Exclusions take precedence.
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
     * When true, follow links on subdomains of the starting URL's domain (e.g. docs.example.com when starting from example.com). www and apex are always treated as equivalent.
     */
    public function withFollowSubdomains(bool $followSubdomains): self
    {
        $self = clone $this;
        $self['followSubdomains'] = $followSubdomains;

        return $self;
    }

    /**
     * When true, the contents of iframes are rendered to Markdown for each crawled page.
     */
    public function withIncludeFrames(bool $includeFrames): self
    {
        $self = clone $this;
        $self['includeFrames'] = $includeFrames;

        return $self;
    }

    /**
     * Include image references in the Markdown output.
     */
    public function withIncludeImages(bool $includeImages): self
    {
        $self = clone $this;
        $self['includeImages'] = $includeImages;

        return $self;
    }

    /**
     * Preserve hyperlinks in the Markdown output.
     */
    public function withIncludeLinks(bool $includeLinks): self
    {
        $self = clone $this;
        $self['includeLinks'] = $includeLinks;

        return $self;
    }

    /**
     * Keep matching HTML subtrees before converting each page to Markdown.
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
     * Maximum cache age in milliseconds. Defaults to 1 day; `0` fetches fresh.
     */
    public function withMaxAgeMs(?int $maxAgeMs): self
    {
        $self = clone $this;
        $self['maxAgeMs'] = $maxAgeMs;

        return $self;
    }

    /**
     * Maximum link depth from the starting URL (0 = only the starting page).
     */
    public function withMaxDepth(int $maxDepth): self
    {
        $self = clone $this;
        $self['maxDepth'] = $maxDepth;

        return $self;
    }

    /**
     * Maximum pages to crawl.
     */
    public function withMaxPages(int $maxPages): self
    {
        $self = clone $this;
        $self['maxPages'] = $maxPages;

        return $self;
    }

    /**
     * PDF handling. `start`/`end` limit parsing to an inclusive, 1-based page range.
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
     * Wait briefly for CSS animations and transitions to settle before reading each page.
     */
    public function withSettleAnimations(bool $settleAnimations): self
    {
        $self = clone $this;
        $self['settleAnimations'] = $settleAnimations;

        return $self;
    }

    /**
     * Truncate base64-encoded image data in the Markdown output.
     */
    public function withShortenBase64Images(bool $shortenBase64Images): self
    {
        $self = clone $this;
        $self['shortenBase64Images'] = $shortenBase64Images;

        return $self;
    }

    /**
     * Soft crawl deadline in milliseconds. Returns pages collected before the next deadline check.
     */
    public function withStopAfterMs(int $stopAfterMs): self
    {
        $self = clone $this;
        $self['stopAfterMs'] = $stopAfterMs;

        return $self;
    }

    /**
     * Labels for filtering usage in the dashboard.
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
     * Regex pattern. Only URLs matching this pattern will be followed and scraped. An automatic prefix scope in the form ^<starting URL> follows a redirect of the starting page.
     */
    public function withURLRegex(string $urlRegex): self
    {
        $self = clone $this;
        $self['urlRegex'] = $urlRegex;

        return $self;
    }

    /**
     * Extract only the main content, stripping headers, footers, sidebars, and navigation.
     */
    public function withUseMainContentOnly(bool $useMainContentOnly): self
    {
        $self = clone $this;
        $self['useMainContentOnly'] = $useMainContentOnly;

        return $self;
    }

    /**
     * Browser wait time in milliseconds after initial page load for each crawled page. Defaults to 3500 (3.5 seconds). Min: 0. Max: 30000 (30 seconds).
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
