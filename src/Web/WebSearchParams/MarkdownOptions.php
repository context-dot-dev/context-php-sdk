<?php

declare(strict_types=1);

namespace ContextDev\Web\WebSearchParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebSearchParams\MarkdownOptions\IncludeFrames;
use ContextDev\Web\WebSearchParams\MarkdownOptions\IncludeFrames\UnionMember1;
use ContextDev\Web\WebSearchParams\MarkdownOptions\Pdf;
use ContextDev\Web\WebSearchParams\MarkdownOptions\TimeoutOpts;

/**
 * Scrape each result page to Markdown. Set `enabled` to `true` to turn it on.
 *
 * @phpstan-import-type IncludeFramesVariants from \ContextDev\Web\WebSearchParams\MarkdownOptions\IncludeFrames
 * @phpstan-import-type IncludeFramesShape from \ContextDev\Web\WebSearchParams\MarkdownOptions\IncludeFrames
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebSearchParams\MarkdownOptions\Pdf
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebSearchParams\MarkdownOptions\TimeoutOpts
 *
 * @phpstan-type MarkdownOptionsShape = array{
 *   enabled?: bool|null,
 *   includeFrames?: IncludeFramesShape|null,
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
     * Scrape each result page to Markdown. Adds 1 credit per result that returns Markdown.
     */
    #[Optional]
    public ?bool $enabled;

    /**
     * Which iframe contents to include in the Markdown. `auto` inlines only iframes that hold page content, such as same-site documents, framesets, job boards, forms, and embedded documents, and skips ads and widgets. `true` inlines every iframe; `false` inlines none.
     *
     * @var IncludeFramesVariants|null $includeFrames
     */
    #[Optional(union: IncludeFrames::class)]
    public bool|string|null $includeFrames;

    /**
     * Include image references in the Markdown.
     */
    #[Optional]
    public ?bool $includeImages;

    /**
     * Keep link URLs in the Markdown.
     */
    #[Optional]
    public ?bool $includeLinks;

    /**
     * Maximum age of a cached result, in milliseconds. `0` always fetches fresh. Defaults to 180 days (15552000000 ms) with Markdown, or 365 days (31536000000 ms) with highlights only.
     */
    #[Optional(nullable: true)]
    public ?int $maxAgeMs;

    /**
     * Whether to parse PDFs and which pages to read.
     */
    #[Optional]
    public ?Pdf $pdf;

    /**
     * Shorten inline base64 image data.
     */
    #[Optional]
    public ?bool $shortenBase64Images;

    /**
     * Request deadline and what to return when it passes.
     */
    #[Optional]
    public ?TimeoutOpts $timeoutOpts;

    /**
     * Keep only the main content, without navigation, headers, footers, or sidebars.
     */
    #[Optional]
    public ?bool $useMainContentOnly;

    /**
     * Time to wait after each result page loads before reading it, in milliseconds. `0` waits 500 ms. Helps with JavaScript-heavy pages.
     */
    #[Optional(nullable: true)]
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
     * @param IncludeFramesShape|null $includeFrames
     * @param Pdf|PdfShape|null $pdf
     * @param TimeoutOpts|TimeoutOptsShape|null $timeoutOpts
     */
    public static function with(
        ?bool $enabled = null,
        bool|UnionMember1|string|null $includeFrames = null,
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
     * Scrape each result page to Markdown. Adds 1 credit per result that returns Markdown.
     */
    public function withEnabled(bool $enabled): self
    {
        $self = clone $this;
        $self['enabled'] = $enabled;

        return $self;
    }

    /**
     * Which iframe contents to include in the Markdown. `auto` inlines only iframes that hold page content, such as same-site documents, framesets, job boards, forms, and embedded documents, and skips ads and widgets. `true` inlines every iframe; `false` inlines none.
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
     * Include image references in the Markdown.
     */
    public function withIncludeImages(bool $includeImages): self
    {
        $self = clone $this;
        $self['includeImages'] = $includeImages;

        return $self;
    }

    /**
     * Keep link URLs in the Markdown.
     */
    public function withIncludeLinks(bool $includeLinks): self
    {
        $self = clone $this;
        $self['includeLinks'] = $includeLinks;

        return $self;
    }

    /**
     * Maximum age of a cached result, in milliseconds. `0` always fetches fresh. Defaults to 180 days (15552000000 ms) with Markdown, or 365 days (31536000000 ms) with highlights only.
     */
    public function withMaxAgeMs(?int $maxAgeMs): self
    {
        $self = clone $this;
        $self['maxAgeMs'] = $maxAgeMs;

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
     * Shorten inline base64 image data.
     */
    public function withShortenBase64Images(bool $shortenBase64Images): self
    {
        $self = clone $this;
        $self['shortenBase64Images'] = $shortenBase64Images;

        return $self;
    }

    /**
     * Request deadline and what to return when it passes.
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
     * Keep only the main content, without navigation, headers, footers, or sidebars.
     */
    public function withUseMainContentOnly(bool $useMainContentOnly): self
    {
        $self = clone $this;
        $self['useMainContentOnly'] = $useMainContentOnly;

        return $self;
    }

    /**
     * Time to wait after each result page loads before reading it, in milliseconds. `0` waits 500 ms. Helps with JavaScript-heavy pages.
     */
    public function withWaitForMs(?int $waitForMs): self
    {
        $self = clone $this;
        $self['waitForMs'] = $waitForMs;

        return $self;
    }
}
