<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebScrapeMdParams\Country;
use ContextDev\Web\WebWebScrapeMdParams\IncludeFrames;
use ContextDev\Web\WebWebScrapeMdParams\IncludeFrames\UnionMember1;
use ContextDev\Web\WebWebScrapeMdParams\IncludeImages;
use ContextDev\Web\WebWebScrapeMdParams\IncludeLinks;
use ContextDev\Web\WebWebScrapeMdParams\Pdf;
use ContextDev\Web\WebWebScrapeMdParams\SettleAnimations;
use ContextDev\Web\WebWebScrapeMdParams\ShortenBase64Images;
use ContextDev\Web\WebWebScrapeMdParams\UseMainContentOnly;
use ContextDev\Web\WebWebScrapeMdParams\Zdr;

/**
 * Scrapes the given URL into LLM usable Markdown. Inspect key_metadata on JSON responses from a recognized API key; use error_code to distinguish stable failure categories.
 *
 * ### Billing & errors
 *
 * | HTTP status | Billed? | Meaning |
 * | --- | --- | --- |
 * | 200 | Yes — 1 credit | Successful scrape, including a zero-length result when includeSelectors matched nothing |
 * | 400 | No | Invalid input, skipped PDF, or the page could not be scraped |
 * | 401 / 403 | No | Invalid/disabled key, insufficient permissions, or credits exhausted; inspect error_code |
 * | 404 | No | Target page returned or fingerprinted as not found |
 * | 408 | No | Request timed out |
 * | 415 | No | Unsupported content type |
 * | 429 | No | Per-minute rate limit exceeded; honor Retry-After |
 * | 500 | No | Internal error |
 *
 * @see ContextDev\Services\WebService::webScrapeMd()
 *
 * @phpstan-import-type IncludeFramesVariants from \ContextDev\Web\WebWebScrapeMdParams\IncludeFrames
 * @phpstan-import-type IncludeImagesVariants from \ContextDev\Web\WebWebScrapeMdParams\IncludeImages
 * @phpstan-import-type IncludeLinksVariants from \ContextDev\Web\WebWebScrapeMdParams\IncludeLinks
 * @phpstan-import-type SettleAnimationsVariants from \ContextDev\Web\WebWebScrapeMdParams\SettleAnimations
 * @phpstan-import-type ShortenBase64ImagesVariants from \ContextDev\Web\WebWebScrapeMdParams\ShortenBase64Images
 * @phpstan-import-type UseMainContentOnlyVariants from \ContextDev\Web\WebWebScrapeMdParams\UseMainContentOnly
 * @phpstan-import-type IncludeFramesShape from \ContextDev\Web\WebWebScrapeMdParams\IncludeFrames
 * @phpstan-import-type IncludeImagesShape from \ContextDev\Web\WebWebScrapeMdParams\IncludeImages
 * @phpstan-import-type IncludeLinksShape from \ContextDev\Web\WebWebScrapeMdParams\IncludeLinks
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebWebScrapeMdParams\Pdf
 * @phpstan-import-type SettleAnimationsShape from \ContextDev\Web\WebWebScrapeMdParams\SettleAnimations
 * @phpstan-import-type ShortenBase64ImagesShape from \ContextDev\Web\WebWebScrapeMdParams\ShortenBase64Images
 * @phpstan-import-type UseMainContentOnlyShape from \ContextDev\Web\WebWebScrapeMdParams\UseMainContentOnly
 *
 * @phpstan-type WebWebScrapeMdParamsShape = array{
 *   url: string,
 *   country?: null|Country|value-of<Country>,
 *   excludeSelectors?: list<string>|null,
 *   headers?: array<string,string>|null,
 *   includeFrames?: IncludeFramesShape|null,
 *   includeImages?: IncludeImagesShape|null,
 *   includeLinks?: IncludeLinksShape|null,
 *   includeSelectors?: list<string>|null,
 *   maxAgeMs?: int|null,
 *   pdf?: null|Pdf|PdfShape,
 *   settleAnimations?: SettleAnimationsShape|null,
 *   shortenBase64Images?: ShortenBase64ImagesShape|null,
 *   tags?: list<string>|null,
 *   timeoutMs?: int|null,
 *   useMainContentOnly?: UseMainContentOnlyShape|null,
 *   waitForMs?: int|null,
 *   zdr?: null|Zdr|value-of<Zdr>,
 * }
 */
final class WebWebScrapeMdParams implements BaseModel
{
    /** @use SdkModel<WebWebScrapeMdParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Full URL to scrape into LLM usable Markdown (must include http:// or https:// protocol).
     */
    #[Required]
    public string $url;

    /**
     * Two-letter ISO 3166-1 alpha-2 country code identifying a supported Context.dev residential proxy exit location. Must be one of Context.dev's supported countries. When provided, Context.dev fetches the target page from that country.
     *
     * @var value-of<Country>|null $country
     */
    #[Optional(enum: Country::class)]
    public ?string $country;

    /**
     * CSS selectors to remove before conversion to Markdown. Applied after includeSelectors. Exclusion takes precedence: an element matching both is removed. Examples: "nav", "footer", ".ad-banner", "[aria-hidden=true]".
     *
     * @var list<string>|null $excludeSelectors
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $excludeSelectors;

    /**
     * Optional outbound HTTP headers forwarded only to the target URL, sent as deep-object query params such as headers[X-Custom]=value. When provided, caching is bypassed: the result is neither read from nor written to cache.
     *
     * @var array<string,string>|null $headers
     */
    #[Optional(map: 'string')]
    public ?array $headers;

    /**
     * When true, the contents of iframes are rendered to Markdown.
     *
     * @var IncludeFramesVariants|null $includeFrames
     */
    #[Optional(union: IncludeFrames::class)]
    public bool|string|null $includeFrames;

    /**
     * Include image references in Markdown output.
     *
     * @var IncludeImagesVariants|null $includeImages
     */
    #[Optional(union: IncludeImages::class)]
    public bool|string|null $includeImages;

    /**
     * Preserve hyperlinks in Markdown output.
     *
     * @var IncludeLinksVariants|null $includeLinks
     */
    #[Optional(union: IncludeLinks::class)]
    public bool|string|null $includeLinks;

    /**
     * CSS selectors. When provided, only matching HTML subtrees (and their descendants) are kept before conversion to Markdown. When omitted, the entire document is kept. Examples: "article.main", "#content", "[role=main]".
     *
     * @var list<string>|null $includeSelectors
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $includeSelectors;

    /**
     * Return a cached result if a prior scrape for the same parameters exists and is younger than this many milliseconds. Defaults to 1 day (86400000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always scrape fresh.
     */
    #[Optional(nullable: true)]
    public ?int $maxAgeMs;

    /**
     * PDF parsing controls. Use start/end to limit text extraction and embedded-image detection/OCR to an inclusive 1-based page range.
     */
    #[Optional]
    public ?Pdf $pdf;

    /**
     * When true, waits briefly for CSS and transition animations to settle before converting to Markdown. Defaults to false. This adds a bit of latency in exchange for more stable output on animated pages.
     *
     * @var SettleAnimationsVariants|null $settleAnimations
     */
    #[Optional(union: SettleAnimations::class)]
    public bool|string|null $settleAnimations;

    /**
     * Shorten base64-encoded image data in the Markdown output.
     *
     * @var ShortenBase64ImagesVariants|null $shortenBase64Images
     */
    #[Optional(union: ShortenBase64Images::class)]
    public bool|string|null $shortenBase64Images;

    /**
     * Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    #[Optional]
    public ?int $timeoutMs;

    /**
     * Extract only the main content of the page, excluding headers, footers, sidebars, and navigation.
     *
     * @var UseMainContentOnlyVariants|null $useMainContentOnly
     */
    #[Optional(union: UseMainContentOnly::class)]
    public bool|string|null $useMainContentOnly;

    /**
     * Optional browser wait time in milliseconds after initial page load before converting the page to Markdown. Min: 0. Max: 30000 (30 seconds).
     */
    #[Optional(nullable: true)]
    public ?int $waitForMs;

    /**
     * Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
     *
     * @var value-of<Zdr>|null $zdr
     */
    #[Optional(enum: Zdr::class)]
    public ?string $zdr;

    /**
     * `new WebWebScrapeMdParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebWebScrapeMdParams::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebWebScrapeMdParams)->withURL(...)
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
     * @param array<string,string>|null $headers
     * @param IncludeFramesShape|null $includeFrames
     * @param IncludeImagesShape|null $includeImages
     * @param IncludeLinksShape|null $includeLinks
     * @param list<string>|null $includeSelectors
     * @param Pdf|PdfShape|null $pdf
     * @param SettleAnimationsShape|null $settleAnimations
     * @param ShortenBase64ImagesShape|null $shortenBase64Images
     * @param list<string>|null $tags
     * @param UseMainContentOnlyShape|null $useMainContentOnly
     * @param Zdr|value-of<Zdr>|null $zdr
     */
    public static function with(
        string $url,
        Country|string|null $country = null,
        ?array $excludeSelectors = null,
        ?array $headers = null,
        bool|UnionMember1|string|null $includeFrames = null,
        bool|IncludeImages\UnionMember1|string|null $includeImages = null,
        bool|IncludeLinks\UnionMember1|string|null $includeLinks = null,
        ?array $includeSelectors = null,
        ?int $maxAgeMs = null,
        Pdf|array|null $pdf = null,
        bool|SettleAnimations\UnionMember1|string|null $settleAnimations = null,
        bool|ShortenBase64Images\UnionMember1|string|null $shortenBase64Images = null,
        ?array $tags = null,
        ?int $timeoutMs = null,
        bool|UseMainContentOnly\UnionMember1|string|null $useMainContentOnly = null,
        ?int $waitForMs = null,
        Zdr|string|null $zdr = null,
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $country && $self['country'] = $country;
        null !== $excludeSelectors && $self['excludeSelectors'] = $excludeSelectors;
        null !== $headers && $self['headers'] = $headers;
        null !== $includeFrames && $self['includeFrames'] = $includeFrames;
        null !== $includeImages && $self['includeImages'] = $includeImages;
        null !== $includeLinks && $self['includeLinks'] = $includeLinks;
        null !== $includeSelectors && $self['includeSelectors'] = $includeSelectors;
        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
        null !== $pdf && $self['pdf'] = $pdf;
        null !== $settleAnimations && $self['settleAnimations'] = $settleAnimations;
        null !== $shortenBase64Images && $self['shortenBase64Images'] = $shortenBase64Images;
        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutMs && $self['timeoutMs'] = $timeoutMs;
        null !== $useMainContentOnly && $self['useMainContentOnly'] = $useMainContentOnly;
        null !== $waitForMs && $self['waitForMs'] = $waitForMs;
        null !== $zdr && $self['zdr'] = $zdr;

        return $self;
    }

    /**
     * Full URL to scrape into LLM usable Markdown (must include http:// or https:// protocol).
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Two-letter ISO 3166-1 alpha-2 country code identifying a supported Context.dev residential proxy exit location. Must be one of Context.dev's supported countries. When provided, Context.dev fetches the target page from that country.
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
     * CSS selectors to remove before conversion to Markdown. Applied after includeSelectors. Exclusion takes precedence: an element matching both is removed. Examples: "nav", "footer", ".ad-banner", "[aria-hidden=true]".
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
     * Optional outbound HTTP headers forwarded only to the target URL, sent as deep-object query params such as headers[X-Custom]=value. When provided, caching is bypassed: the result is neither read from nor written to cache.
     *
     * @param array<string,string> $headers
     */
    public function withHeaders(array $headers): self
    {
        $self = clone $this;
        $self['headers'] = $headers;

        return $self;
    }

    /**
     * When true, the contents of iframes are rendered to Markdown.
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
     * Include image references in Markdown output.
     *
     * @param IncludeImagesShape $includeImages
     */
    public function withIncludeImages(
        bool|IncludeImages\UnionMember1|string $includeImages,
    ): self {
        $self = clone $this;
        $self['includeImages'] = $includeImages;

        return $self;
    }

    /**
     * Preserve hyperlinks in Markdown output.
     *
     * @param IncludeLinksShape $includeLinks
     */
    public function withIncludeLinks(
        bool|IncludeLinks\UnionMember1|string $includeLinks,
    ): self {
        $self = clone $this;
        $self['includeLinks'] = $includeLinks;

        return $self;
    }

    /**
     * CSS selectors. When provided, only matching HTML subtrees (and their descendants) are kept before conversion to Markdown. When omitted, the entire document is kept. Examples: "article.main", "#content", "[role=main]".
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
     * Return a cached result if a prior scrape for the same parameters exists and is younger than this many milliseconds. Defaults to 1 day (86400000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always scrape fresh.
     */
    public function withMaxAgeMs(?int $maxAgeMs): self
    {
        $self = clone $this;
        $self['maxAgeMs'] = $maxAgeMs;

        return $self;
    }

    /**
     * PDF parsing controls. Use start/end to limit text extraction and embedded-image detection/OCR to an inclusive 1-based page range.
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
     * When true, waits briefly for CSS and transition animations to settle before converting to Markdown. Defaults to false. This adds a bit of latency in exchange for more stable output on animated pages.
     *
     * @param SettleAnimationsShape $settleAnimations
     */
    public function withSettleAnimations(
        bool|SettleAnimations\UnionMember1|string $settleAnimations,
    ): self {
        $self = clone $this;
        $self['settleAnimations'] = $settleAnimations;

        return $self;
    }

    /**
     * Shorten base64-encoded image data in the Markdown output.
     *
     * @param ShortenBase64ImagesShape $shortenBase64Images
     */
    public function withShortenBase64Images(
        bool|ShortenBase64Images\UnionMember1|string $shortenBase64Images,
    ): self {
        $self = clone $this;
        $self['shortenBase64Images'] = $shortenBase64Images;

        return $self;
    }

    /**
     * Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
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
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    public function withTimeoutMs(int $timeoutMs): self
    {
        $self = clone $this;
        $self['timeoutMs'] = $timeoutMs;

        return $self;
    }

    /**
     * Extract only the main content of the page, excluding headers, footers, sidebars, and navigation.
     *
     * @param UseMainContentOnlyShape $useMainContentOnly
     */
    public function withUseMainContentOnly(
        bool|UseMainContentOnly\UnionMember1|string $useMainContentOnly,
    ): self {
        $self = clone $this;
        $self['useMainContentOnly'] = $useMainContentOnly;

        return $self;
    }

    /**
     * Optional browser wait time in milliseconds after initial page load before converting the page to Markdown. Min: 0. Max: 30000 (30 seconds).
     */
    public function withWaitForMs(?int $waitForMs): self
    {
        $self = clone $this;
        $self['waitForMs'] = $waitForMs;

        return $self;
    }

    /**
     * Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
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
