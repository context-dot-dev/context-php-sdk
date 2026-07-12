<?php

declare(strict_types=1);

namespace ContextDev\Parse;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Converts raw text, source code, web/data, PDF, Microsoft Office, and image bytes into LLM-usable Markdown.
 *
 * @see ContextDev\Services\ParseService::handle()
 *
 * @phpstan-type ParseHandleParamsShape = array{
 *   baseURL?: string|null,
 *   extension?: string|null,
 *   filename?: string|null,
 *   includeImages?: bool|null,
 *   includeLinks?: bool|null,
 *   ocr?: bool|null,
 *   pdfEnd?: int|null,
 *   pdfStart?: int|null,
 *   shortenBase64Images?: bool|null,
 *   useMainContentOnly?: bool|null,
 * }
 */
final class ParseHandleParams implements BaseModel
{
    /** @use SdkModel<ParseHandleParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Optional HTTP(S) source document URL used to resolve relative links and image references. Relative references remain relative when omitted.
     */
    #[Optional]
    public ?string $baseURL;

    /**
     * Optional file extension hint, such as pdf, docx, xlsx, pptx, html, json, csv, md, py, rtf, jpg, png, or txt.
     */
    #[Optional]
    public ?string $extension;

    /**
     * Optional filename hint used to infer the extension when extension is omitted.
     */
    #[Optional]
    public ?string $filename;

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
     * When true for PDF inputs, detect and OCR images embedded in the selected pages, inserting recognized text at each image's position in page reading order while preserving the PDF text layer. pdfStart/pdfEnd limit the inclusive page range. This is separate from automatic scanned-PDF OCR fallback.
     */
    #[Optional]
    public ?bool $ocr;

    /**
     * Last 1-based PDF page to parse. When omitted, parsing ends at the last page. Must be greater than or equal to pdfStart when both are provided.
     */
    #[Optional]
    public ?int $pdfEnd;

    /**
     * First 1-based PDF page to parse. When omitted, parsing starts at the first page.
     */
    #[Optional]
    public ?int $pdfStart;

    /**
     * Shorten base64-encoded image data in the Markdown output.
     */
    #[Optional]
    public ?bool $shortenBase64Images;

    /**
     * Extract only the main content from HTML-like inputs.
     */
    #[Optional]
    public ?bool $useMainContentOnly;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $baseURL = null,
        ?string $extension = null,
        ?string $filename = null,
        ?bool $includeImages = null,
        ?bool $includeLinks = null,
        ?bool $ocr = null,
        ?int $pdfEnd = null,
        ?int $pdfStart = null,
        ?bool $shortenBase64Images = null,
        ?bool $useMainContentOnly = null,
    ): self {
        $self = new self;

        null !== $baseURL && $self['baseURL'] = $baseURL;
        null !== $extension && $self['extension'] = $extension;
        null !== $filename && $self['filename'] = $filename;
        null !== $includeImages && $self['includeImages'] = $includeImages;
        null !== $includeLinks && $self['includeLinks'] = $includeLinks;
        null !== $ocr && $self['ocr'] = $ocr;
        null !== $pdfEnd && $self['pdfEnd'] = $pdfEnd;
        null !== $pdfStart && $self['pdfStart'] = $pdfStart;
        null !== $shortenBase64Images && $self['shortenBase64Images'] = $shortenBase64Images;
        null !== $useMainContentOnly && $self['useMainContentOnly'] = $useMainContentOnly;

        return $self;
    }

    /**
     * Optional HTTP(S) source document URL used to resolve relative links and image references. Relative references remain relative when omitted.
     */
    public function withBaseURL(string $baseURL): self
    {
        $self = clone $this;
        $self['baseURL'] = $baseURL;

        return $self;
    }

    /**
     * Optional file extension hint, such as pdf, docx, xlsx, pptx, html, json, csv, md, py, rtf, jpg, png, or txt.
     */
    public function withExtension(string $extension): self
    {
        $self = clone $this;
        $self['extension'] = $extension;

        return $self;
    }

    /**
     * Optional filename hint used to infer the extension when extension is omitted.
     */
    public function withFilename(string $filename): self
    {
        $self = clone $this;
        $self['filename'] = $filename;

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
     * When true for PDF inputs, detect and OCR images embedded in the selected pages, inserting recognized text at each image's position in page reading order while preserving the PDF text layer. pdfStart/pdfEnd limit the inclusive page range. This is separate from automatic scanned-PDF OCR fallback.
     */
    public function withOcr(bool $ocr): self
    {
        $self = clone $this;
        $self['ocr'] = $ocr;

        return $self;
    }

    /**
     * Last 1-based PDF page to parse. When omitted, parsing ends at the last page. Must be greater than or equal to pdfStart when both are provided.
     */
    public function withPdfEnd(int $pdfEnd): self
    {
        $self = clone $this;
        $self['pdfEnd'] = $pdfEnd;

        return $self;
    }

    /**
     * First 1-based PDF page to parse. When omitted, parsing starts at the first page.
     */
    public function withPdfStart(int $pdfStart): self
    {
        $self = clone $this;
        $self['pdfStart'] = $pdfStart;

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
     * Extract only the main content from HTML-like inputs.
     */
    public function withUseMainContentOnly(bool $useMainContentOnly): self
    {
        $self = clone $this;
        $self['useMainContentOnly'] = $useMainContentOnly;

        return $self;
    }
}
