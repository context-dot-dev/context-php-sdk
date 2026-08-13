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
 * Converts raw text, source code, web/data, PDF, Microsoft Office, and image bytes into LLM-usable Markdown.
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
     * Optional client identifier used for usage attribution.
     */
    #[Optional]
    public ?string $client;

    /**
     * Optional file extension hint, such as pdf, docx, xlsx, pptx, html, json, csv, md, py, rtf, jpg, png, or txt.
     *
     * @var value-of<Extension>|null $extension
     */
    #[Optional(enum: Extension::class)]
    public ?string $extension;

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
     * When true for PDF inputs, OCR the selected pages that have no usable text layer (scans), replacing each recovered page's text with the OCR result while pages with a real text layer keep it. pdf.start/pdf.end limit the inclusive page range. Billed at 1 credit per page OCR actually recovered, on top of the base request cost. When false, no OCR runs.
     */
    #[Optional]
    public ?bool $ocr;

    /**
     * PDF page-range options as a JSON object, e.g. {"start": 2, "end": 5}.
     */
    #[Optional]
    public ?Pdf $pdf;

    /**
     * Shorten base64-encoded image data in the Markdown output.
     */
    #[Optional]
    public ?bool $shortenBase64Images;

    /**
     * Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Extract only the main content from HTML-like inputs.
     */
    #[Optional]
    public ?bool $useMainContentOnly;

    /**
     * Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
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
        null !== $ocr && $self['ocr'] = $ocr;
        null !== $pdf && $self['pdf'] = $pdf;
        null !== $shortenBase64Images && $self['shortenBase64Images'] = $shortenBase64Images;
        null !== $tags && $self['tags'] = $tags;
        null !== $useMainContentOnly && $self['useMainContentOnly'] = $useMainContentOnly;
        null !== $zdr && $self['zdr'] = $zdr;

        return $self;
    }

    /**
     * Optional client identifier used for usage attribution.
     */
    public function withClient(string $client): self
    {
        $self = clone $this;
        $self['client'] = $client;

        return $self;
    }

    /**
     * Optional file extension hint, such as pdf, docx, xlsx, pptx, html, json, csv, md, py, rtf, jpg, png, or txt.
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
     * When true for PDF inputs, OCR the selected pages that have no usable text layer (scans), replacing each recovered page's text with the OCR result while pages with a real text layer keep it. pdf.start/pdf.end limit the inclusive page range. Billed at 1 credit per page OCR actually recovered, on top of the base request cost. When false, no OCR runs.
     */
    public function withOcr(bool $ocr): self
    {
        $self = clone $this;
        $self['ocr'] = $ocr;

        return $self;
    }

    /**
     * PDF page-range options as a JSON object, e.g. {"start": 2, "end": 5}.
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
     * Extract only the main content from HTML-like inputs.
     */
    public function withUseMainContentOnly(bool $useMainContentOnly): self
    {
        $self = clone $this;
        $self['useMainContentOnly'] = $useMainContentOnly;

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
