<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebScrapeMdParams\Pdf;

/**
 * Scrapes the given URL into LLM usable Markdown.
 *
 * @see ContextDev\Services\WebService::webScrapeMd()
 *
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebWebScrapeMdParams\Pdf
 *
 * @phpstan-type WebWebScrapeMdParamsShape = array{
 *   url: string,
 *   excludeSelectors?: list<string>|null,
 *   headers?: array<string,string>|null,
 *   includeFrames?: bool|null,
 *   includeImages?: bool|null,
 *   includeLinks?: bool|null,
 *   includeSelectors?: list<string>|null,
 *   maxAgeMs?: int|null,
 *   pdf?: null|Pdf|PdfShape,
 *   shortenBase64Images?: bool|null,
 *   timeoutMs?: int|null,
 *   useMainContentOnly?: bool|null,
 *   waitForMs?: int|null,
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
     * CSS selectors to remove before conversion to Markdown. Applied after includeSelectors. Exclusion takes precedence: an element matching both is removed. Examples: "nav", "footer", ".ad-banner", "[aria-hidden=true]".
     *
     * @var list<string>|null $excludeSelectors
     */
    #[Optional(list: 'string')]
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
     */
    #[Optional]
    public ?bool $includeFrames;

    /**
     * Include image references in Markdown output.
     */
    #[Optional]
    public ?bool $includeImages;

    /**
     * Preserve hyperlinks in Markdown output.
     */
    #[Optional]
    public ?bool $includeLinks;

    /**
     * CSS selectors. When provided, only matching HTML subtrees (and their descendants) are kept before conversion to Markdown. When omitted, the entire document is kept. Examples: "article.main", "#content", "[role=main]".
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
     * PDF parsing controls. Use start/end to limit text extraction and OCR to an inclusive 1-based page range.
     */
    #[Optional]
    public ?Pdf $pdf;

    /**
     * Shorten base64-encoded image data in the Markdown output.
     */
    #[Optional]
    public ?bool $shortenBase64Images;

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    #[Optional]
    public ?int $timeoutMs;

    /**
     * Extract only the main content of the page, excluding headers, footers, sidebars, and navigation.
     */
    #[Optional]
    public ?bool $useMainContentOnly;

    /**
     * Optional browser wait time in milliseconds after initial page load before converting the page to Markdown. Min: 0. Max: 30000 (30 seconds).
     */
    #[Optional]
    public ?int $waitForMs;

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
     * @param list<string>|null $excludeSelectors
     * @param array<string,string>|null $headers
     * @param list<string>|null $includeSelectors
     * @param Pdf|PdfShape|null $pdf
     */
    public static function with(
        string $url,
        ?array $excludeSelectors = null,
        ?array $headers = null,
        ?bool $includeFrames = null,
        ?bool $includeImages = null,
        ?bool $includeLinks = null,
        ?array $includeSelectors = null,
        ?int $maxAgeMs = null,
        Pdf|array|null $pdf = null,
        ?bool $shortenBase64Images = null,
        ?int $timeoutMs = null,
        ?bool $useMainContentOnly = null,
        ?int $waitForMs = null,
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $excludeSelectors && $self['excludeSelectors'] = $excludeSelectors;
        null !== $headers && $self['headers'] = $headers;
        null !== $includeFrames && $self['includeFrames'] = $includeFrames;
        null !== $includeImages && $self['includeImages'] = $includeImages;
        null !== $includeLinks && $self['includeLinks'] = $includeLinks;
        null !== $includeSelectors && $self['includeSelectors'] = $includeSelectors;
        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
        null !== $pdf && $self['pdf'] = $pdf;
        null !== $shortenBase64Images && $self['shortenBase64Images'] = $shortenBase64Images;
        null !== $timeoutMs && $self['timeoutMs'] = $timeoutMs;
        null !== $useMainContentOnly && $self['useMainContentOnly'] = $useMainContentOnly;
        null !== $waitForMs && $self['waitForMs'] = $waitForMs;

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
     * CSS selectors to remove before conversion to Markdown. Applied after includeSelectors. Exclusion takes precedence: an element matching both is removed. Examples: "nav", "footer", ".ad-banner", "[aria-hidden=true]".
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
     */
    public function withIncludeFrames(bool $includeFrames): self
    {
        $self = clone $this;
        $self['includeFrames'] = $includeFrames;

        return $self;
    }

    /**
     * Include image references in Markdown output.
     */
    public function withIncludeImages(bool $includeImages): self
    {
        $self = clone $this;
        $self['includeImages'] = $includeImages;

        return $self;
    }

    /**
     * Preserve hyperlinks in Markdown output.
     */
    public function withIncludeLinks(bool $includeLinks): self
    {
        $self = clone $this;
        $self['includeLinks'] = $includeLinks;

        return $self;
    }

    /**
     * CSS selectors. When provided, only matching HTML subtrees (and their descendants) are kept before conversion to Markdown. When omitted, the entire document is kept. Examples: "article.main", "#content", "[role=main]".
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
     * Shorten base64-encoded image data in the Markdown output.
     */
    public function withShortenBase64Images(bool $shortenBase64Images): self
    {
        $self = clone $this;
        $self['shortenBase64Images'] = $shortenBase64Images;

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
     */
    public function withUseMainContentOnly(bool $useMainContentOnly): self
    {
        $self = clone $this;
        $self['useMainContentOnly'] = $useMainContentOnly;

        return $self;
    }

    /**
     * Optional browser wait time in milliseconds after initial page load before converting the page to Markdown. Min: 0. Max: 30000 (30 seconds).
     */
    public function withWaitForMs(int $waitForMs): self
    {
        $self = clone $this;
        $self['waitForMs'] = $waitForMs;

        return $self;
    }
}
