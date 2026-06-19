<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebCrawlMdParams\Pdf;

/**
 * Performs a crawl starting from a given URL, extracts page content as Markdown, and returns results for all crawled pages.
 *
 * @see ContextDev\Services\WebService::webCrawlMd()
 *
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebWebCrawlMdParams\Pdf
 *
 * @phpstan-type WebWebCrawlMdParamsShape = array{
 *   url: string,
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
 *   shortenBase64Images?: bool|null,
 *   stopAfterMs?: int|null,
 *   timeoutMs?: int|null,
 *   urlRegex?: string|null,
 *   useMainContentOnly?: bool|null,
 *   waitForMs?: int|null,
 * }
 */
final class WebWebCrawlMdParams implements BaseModel
{
    /** @use SdkModel<WebWebCrawlMdParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The starting URL for the crawl (must include http:// or https:// protocol).
     */
    #[Required]
    public string $url;

    /**
     * CSS selectors to remove before each crawled page is converted to Markdown. Applied after includeSelectors. Exclusion takes precedence: an element matching both is removed. Examples: "nav", "footer", ".ad-banner", "[aria-hidden=true]".
     *
     * @var list<string>|null $excludeSelectors
     */
    #[Optional(list: 'string')]
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
     * CSS selectors. When provided, only matching HTML subtrees (and their descendants) are kept before each crawled page is converted to Markdown. When omitted, the entire document is kept. Examples: "article.main", "#content", "[role=main]".
     *
     * @var list<string>|null $includeSelectors
     */
    #[Optional(list: 'string')]
    public ?array $includeSelectors;

    /**
     * Return a cached result if a prior scrape for the same parameters exists and is younger than this many milliseconds. Defaults to 1 day (86400000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always scrape fresh.
     */
    #[Optional]
    public ?int $maxAgeMs;

    /**
     * Maximum link depth from the starting URL (0 = only the starting page).
     */
    #[Optional]
    public ?int $maxDepth;

    /**
     * Maximum number of pages to crawl. Hard cap: 500.
     */
    #[Optional]
    public ?int $maxPages;

    /**
     * PDF parsing controls. Use start/end to limit text extraction and OCR to an inclusive 1-based page range.
     */
    #[Optional]
    public ?Pdf $pdf;

    /**
     * Truncate base64-encoded image data in the Markdown output.
     */
    #[Optional]
    public ?bool $shortenBase64Images;

    /**
     * Soft time budget for the crawl in milliseconds. After each scrape, the crawler checks the elapsed time and, if exceeded, returns the pages collected so far instead of continuing. Min: 10000 (10s). Max: 110000 (110s). Default: 80000 (80s).
     */
    #[Optional]
    public ?int $stopAfterMs;

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    #[Optional('timeoutMS')]
    public ?int $timeoutMs;

    /**
     * Regex pattern. Only URLs matching this pattern will be followed and scraped.
     */
    #[Optional]
    public ?string $urlRegex;

    /**
     * Extract only the main content, stripping headers, footers, sidebars, and navigation.
     */
    #[Optional]
    public ?bool $useMainContentOnly;

    /**
     * Optional browser wait time in milliseconds after initial page load for each crawled page. Min: 0. Max: 30000 (30 seconds).
     */
    #[Optional]
    public ?int $waitForMs;

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
     * @param list<string>|null $excludeSelectors
     * @param list<string>|null $includeSelectors
     * @param Pdf|PdfShape|null $pdf
     */
    public static function with(
        string $url,
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
        ?bool $shortenBase64Images = null,
        ?int $stopAfterMs = null,
        ?int $timeoutMs = null,
        ?string $urlRegex = null,
        ?bool $useMainContentOnly = null,
        ?int $waitForMs = null,
    ): self {
        $self = new self;

        $self['url'] = $url;

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
        null !== $shortenBase64Images && $self['shortenBase64Images'] = $shortenBase64Images;
        null !== $stopAfterMs && $self['stopAfterMs'] = $stopAfterMs;
        null !== $timeoutMs && $self['timeoutMs'] = $timeoutMs;
        null !== $urlRegex && $self['urlRegex'] = $urlRegex;
        null !== $useMainContentOnly && $self['useMainContentOnly'] = $useMainContentOnly;
        null !== $waitForMs && $self['waitForMs'] = $waitForMs;

        return $self;
    }

    /**
     * The starting URL for the crawl (must include http:// or https:// protocol).
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * CSS selectors to remove before each crawled page is converted to Markdown. Applied after includeSelectors. Exclusion takes precedence: an element matching both is removed. Examples: "nav", "footer", ".ad-banner", "[aria-hidden=true]".
     *
     * @param list<string> $excludeSelectors
     */
    public function withExcludeSelectors(array $excludeSelectors): self
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
     * CSS selectors. When provided, only matching HTML subtrees (and their descendants) are kept before each crawled page is converted to Markdown. When omitted, the entire document is kept. Examples: "article.main", "#content", "[role=main]".
     *
     * @param list<string> $includeSelectors
     */
    public function withIncludeSelectors(array $includeSelectors): self
    {
        $self = clone $this;
        $self['includeSelectors'] = $includeSelectors;

        return $self;
    }

    /**
     * Return a cached result if a prior scrape for the same parameters exists and is younger than this many milliseconds. Defaults to 1 day (86400000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always scrape fresh.
     */
    public function withMaxAgeMs(int $maxAgeMs): self
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
     * Maximum number of pages to crawl. Hard cap: 500.
     */
    public function withMaxPages(int $maxPages): self
    {
        $self = clone $this;
        $self['maxPages'] = $maxPages;

        return $self;
    }

    /**
     * PDF parsing controls. Use start/end to limit text extraction and OCR to an inclusive 1-based page range.
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
     * Truncate base64-encoded image data in the Markdown output.
     */
    public function withShortenBase64Images(bool $shortenBase64Images): self
    {
        $self = clone $this;
        $self['shortenBase64Images'] = $shortenBase64Images;

        return $self;
    }

    /**
     * Soft time budget for the crawl in milliseconds. After each scrape, the crawler checks the elapsed time and, if exceeded, returns the pages collected so far instead of continuing. Min: 10000 (10s). Max: 110000 (110s). Default: 80000 (80s).
     */
    public function withStopAfterMs(int $stopAfterMs): self
    {
        $self = clone $this;
        $self['stopAfterMs'] = $stopAfterMs;

        return $self;
    }

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    public function withTimeoutMs(int $timeoutMs): self
    {
        $self = clone $this;
        $self['timeoutMs'] = $timeoutMs;

        return $self;
    }

    /**
     * Regex pattern. Only URLs matching this pattern will be followed and scraped.
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
     * Optional browser wait time in milliseconds after initial page load for each crawled page. Min: 0. Max: 30000 (30 seconds).
     */
    public function withWaitForMs(int $waitForMs): self
    {
        $self = clone $this;
        $self['waitForMs'] = $waitForMs;

        return $self;
    }
}
