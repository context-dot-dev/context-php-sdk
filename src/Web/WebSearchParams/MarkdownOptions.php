<?php

declare(strict_types=1);

namespace ContextDev\Web\WebSearchParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebSearchParams\MarkdownOptions\Pdf;
use ContextDev\Web\WebSearchParams\MarkdownOptions\TimeoutOpts;

/**
 * Inline Markdown scraping for each result. Set `enabled: true` to activate.
 *
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebSearchParams\MarkdownOptions\Pdf
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebSearchParams\MarkdownOptions\TimeoutOpts
 *
 * @phpstan-type MarkdownOptionsShape = array{
 *   enabled?: bool|null,
 *   includeFrames?: bool|null,
 *   includeImages?: bool|null,
 *   includeLinks?: bool|null,
 *   maxAgeMs?: int|null,
 *   pdf?: null|Pdf|PdfShape,
 *   shortenBase64Images?: bool|null,
 *   timeoutOpts?: null|\ContextDev\Web\WebSearchParams\MarkdownOptions\TimeoutOpts|TimeoutOptsShape,
 *   useMainContentOnly?: bool|null,
 *   waitForMs?: int|null,
 * }
 */
final class MarkdownOptions implements BaseModel
{
    /** @use SdkModel<MarkdownOptionsShape> */
    use SdkModel;

    /**
     * Scrape each result to Markdown. Off by default to keep search cheap and fast.
     */
    #[Optional]
    public ?bool $enabled;

    /**
     * Render iframe contents into the Markdown.
     */
    #[Optional]
    public ?bool $includeFrames;

    /**
     * Emit image references in the Markdown.
     */
    #[Optional]
    public ?bool $includeImages;

    /**
     * Keep hyperlinks in the Markdown.
     */
    #[Optional]
    public ?bool $includeLinks;

    /**
     * Cache TTL in ms for scraped Markdown keyed by URL + options. Default 1 day, max 30 days. Set to 0 to force a fresh scrape.
     */
    #[Optional]
    public ?int $maxAgeMs;

    /**
     * PDF handling. Use start/end to bound text extraction and OCR to a page range.
     */
    #[Optional]
    public ?Pdf $pdf;

    /**
     * Truncate inline base64 image payloads to keep responses small.
     */
    #[Optional]
    public ?bool $shortenBase64Images;

    /**
     * Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     */
    #[Optional]
    public ?TimeoutOpts $timeoutOpts;

    /**
     * Strip nav, header, footer, and sidebar — keep only the primary article content.
     */
    #[Optional]
    public ?bool $useMainContentOnly;

    /**
     * Extra wait after page load before rendering, in ms (0–30000). Useful for JS-heavy pages.
     */
    #[Optional]
    public ?int $waitForMs;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Pdf|PdfShape|null $pdf
     * @param TimeoutOpts|TimeoutOptsShape|null $timeoutOpts
     */
    public static function with(
        ?bool $enabled = null,
        ?bool $includeFrames = null,
        ?bool $includeImages = null,
        ?bool $includeLinks = null,
        ?int $maxAgeMs = null,
        Pdf|array|null $pdf = null,
        ?bool $shortenBase64Images = null,
        TimeoutOpts|array|null $timeoutOpts = null,
        ?bool $useMainContentOnly = null,
        ?int $waitForMs = null,
    ): self {
        $self = new self;

        null !== $enabled && $self['enabled'] = $enabled;
        null !== $includeFrames && $self['includeFrames'] = $includeFrames;
        null !== $includeImages && $self['includeImages'] = $includeImages;
        null !== $includeLinks && $self['includeLinks'] = $includeLinks;
        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
        null !== $pdf && $self['pdf'] = $pdf;
        null !== $shortenBase64Images && $self['shortenBase64Images'] = $shortenBase64Images;
        null !== $timeoutOpts && $self['timeoutOpts'] = $timeoutOpts;
        null !== $useMainContentOnly && $self['useMainContentOnly'] = $useMainContentOnly;
        null !== $waitForMs && $self['waitForMs'] = $waitForMs;

        return $self;
    }

    /**
     * Scrape each result to Markdown. Off by default to keep search cheap and fast.
     */
    public function withEnabled(bool $enabled): self
    {
        $self = clone $this;
        $self['enabled'] = $enabled;

        return $self;
    }

    /**
     * Render iframe contents into the Markdown.
     */
    public function withIncludeFrames(bool $includeFrames): self
    {
        $self = clone $this;
        $self['includeFrames'] = $includeFrames;

        return $self;
    }

    /**
     * Emit image references in the Markdown.
     */
    public function withIncludeImages(bool $includeImages): self
    {
        $self = clone $this;
        $self['includeImages'] = $includeImages;

        return $self;
    }

    /**
     * Keep hyperlinks in the Markdown.
     */
    public function withIncludeLinks(bool $includeLinks): self
    {
        $self = clone $this;
        $self['includeLinks'] = $includeLinks;

        return $self;
    }

    /**
     * Cache TTL in ms for scraped Markdown keyed by URL + options. Default 1 day, max 30 days. Set to 0 to force a fresh scrape.
     */
    public function withMaxAgeMs(int $maxAgeMs): self
    {
        $self = clone $this;
        $self['maxAgeMs'] = $maxAgeMs;

        return $self;
    }

    /**
     * PDF handling. Use start/end to bound text extraction and OCR to a page range.
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
     * Truncate inline base64 image payloads to keep responses small.
     */
    public function withShortenBase64Images(bool $shortenBase64Images): self
    {
        $self = clone $this;
        $self['shortenBase64Images'] = $shortenBase64Images;

        return $self;
    }

    /**
     * Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     *
     * @param TimeoutOpts|TimeoutOptsShape $timeoutOpts
     */
    public function withTimeoutOpts(
        TimeoutOpts|array $timeoutOpts,
    ): self {
        $self = clone $this;
        $self['timeoutOpts'] = $timeoutOpts;

        return $self;
    }

    /**
     * Strip nav, header, footer, and sidebar — keep only the primary article content.
     */
    public function withUseMainContentOnly(bool $useMainContentOnly): self
    {
        $self = clone $this;
        $self['useMainContentOnly'] = $useMainContentOnly;

        return $self;
    }

    /**
     * Extra wait after page load before rendering, in ms (0–30000). Useful for JS-heavy pages.
     */
    public function withWaitForMs(int $waitForMs): self
    {
        $self = clone $this;
        $self['waitForMs'] = $waitForMs;

        return $self;
    }
}
