<?php

declare(strict_types=1);

namespace ContextDev\Parse;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Parse\ParseHandleParams\Extension;
use ContextDev\Parse\ParseHandleParams\Pdf;
use ContextDev\Parse\ParseHandleParams\Zdr;

/**
 * Convert a file to Markdown. Handles PDF, Word, Excel, PowerPoint, HTML, XML, CSV, JSON, YAML, source code, subtitles, images, and WARC archives. Send the raw bytes as the request body; set `ocr=true` to read scanned pages and images.
 *
 * @see ContextDev\Services\ParseService::handle()
 *
 * @phpstan-import-type PdfShape from \ContextDev\Parse\ParseHandleParams\Pdf
 *
 * @phpstan-type ParseHandleParamsShape = array{
 *   client?: string|null,
 *   extension?: null|Extension|value-of<Extension>,
 *   includeImages?: bool|null,
 *   includeLinks?: bool|null,
 *   includeNumberedPages?: bool|null,
 *   ocr?: bool|null,
 *   pdf?: null|Pdf|PdfShape,
 *   shortenBase64Images?: bool|null,
 *   tags?: list<string>|null,
 *   useMainContentOnly?: bool|null,
 *   zdr?: null|Zdr|value-of<Zdr>,
 * }
 */
final class ParseHandleParams implements BaseModel
{
    /** @use SdkModel<ParseHandleParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Client identifier for usage attribution.
     */
    #[Optional]
    public ?string $client;

    /**
     * File type hint, such as `pdf`, `docx`, `xlsx`, `pptx`, `html`, `json`, `csv`, `md`, `py`, `rtf`, `jpg`, `png`, `txt`, `warc`, or `warc.gz`. Use it when the `Content-Type` header is missing or generic.
     *
     * @var value-of<Extension>|null $extension
     */
    #[Optional(enum: Extension::class)]
    public ?string $extension;

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
     * Start each PDF page in the Markdown with a `<!-- page N -->` line, where `N` is the original 1-based page number.
     */
    #[Optional]
    public ?bool $includeNumberedPages;

    /**
     * Read text from images and scanned PDF pages with OCR, within the `pdf` page range. Adds 1 credit per page read.
     */
    #[Optional]
    public ?bool $ocr;

    /**
     * PDF page range as a JSON object, such as `{"start": 2, "end": 5}`.
     */
    #[Optional]
    public ?Pdf $pdf;

    /**
     * Shorten inline base64 image data.
     */
    #[Optional]
    public ?bool $shortenBase64Images;

    /**
     * Comma-separated labels for this request, such as `production,team-alpha`. Filter usage and request logs by them.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Keep only the main content, without navigation, headers, footers, or sidebars. Applies to HTML-like inputs.
     */
    #[Optional]
    public ?bool $useMainContentOnly;

    /**
     * `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     *
     * @var value-of<Zdr>|null $zdr
     */
    #[Optional(enum: Zdr::class)]
    public ?string $zdr;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Extension|value-of<Extension>|null $extension
     * @param Pdf|PdfShape|null $pdf
     * @param list<string>|null $tags
     * @param Zdr|value-of<Zdr>|null $zdr
     */
    public static function with(
        ?string $client = null,
        Extension|string|null $extension = null,
        ?bool $includeImages = null,
        ?bool $includeLinks = null,
        ?bool $includeNumberedPages = null,
        ?bool $ocr = null,
        Pdf|array|null $pdf = null,
        ?bool $shortenBase64Images = null,
        ?array $tags = null,
        ?bool $useMainContentOnly = null,
        Zdr|string|null $zdr = null,
    ): self {
        $self = new self;

        null !== $client && $self['client'] = $client;
        null !== $extension && $self['extension'] = $extension;
        null !== $includeImages && $self['includeImages'] = $includeImages;
        null !== $includeLinks && $self['includeLinks'] = $includeLinks;
        null !== $includeNumberedPages && $self['includeNumberedPages'] = $includeNumberedPages;
        null !== $ocr && $self['ocr'] = $ocr;
        null !== $pdf && $self['pdf'] = $pdf;
        null !== $shortenBase64Images && $self['shortenBase64Images'] = $shortenBase64Images;
        null !== $tags && $self['tags'] = $tags;
        null !== $useMainContentOnly && $self['useMainContentOnly'] = $useMainContentOnly;
        null !== $zdr && $self['zdr'] = $zdr;

        return $self;
    }

    /**
     * Client identifier for usage attribution.
     */
    public function withClient(string $client): self
    {
        $self = clone $this;
        $self['client'] = $client;

        return $self;
    }

    /**
     * File type hint, such as `pdf`, `docx`, `xlsx`, `pptx`, `html`, `json`, `csv`, `md`, `py`, `rtf`, `jpg`, `png`, `txt`, `warc`, or `warc.gz`. Use it when the `Content-Type` header is missing or generic.
     *
     * @param Extension|value-of<Extension> $extension
     */
    public function withExtension(Extension|string $extension): self
    {
        $self = clone $this;
        $self['extension'] = $extension;

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
     * Start each PDF page in the Markdown with a `<!-- page N -->` line, where `N` is the original 1-based page number.
     */
    public function withIncludeNumberedPages(bool $includeNumberedPages): self
    {
        $self = clone $this;
        $self['includeNumberedPages'] = $includeNumberedPages;

        return $self;
    }

    /**
     * Read text from images and scanned PDF pages with OCR, within the `pdf` page range. Adds 1 credit per page read.
     */
    public function withOcr(bool $ocr): self
    {
        $self = clone $this;
        $self['ocr'] = $ocr;

        return $self;
    }

    /**
     * PDF page range as a JSON object, such as `{"start": 2, "end": 5}`.
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
     * Comma-separated labels for this request, such as `production,team-alpha`. Filter usage and request logs by them.
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
     * Keep only the main content, without navigation, headers, footers, or sidebars. Applies to HTML-like inputs.
     */
    public function withUseMainContentOnly(bool $useMainContentOnly): self
    {
        $self = clone $this;
        $self['useMainContentOnly'] = $useMainContentOnly;

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
