<?php

declare(strict_types=1);

namespace ContextDev\Parse;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Parse\ParseHandleParams\Extension;
use ContextDev\Parse\ParseHandleParams\Pdf;

/**
 * Converts raw text, source code, web/data, PDF, Microsoft Office, and image bytes into LLM-usable Markdown. The base request costs 1 credit. When OCR runs (requires ocr=true), the entire call costs 5 credits; ocr=true requests where no OCR ends up running still cost 1 credit.
 *
 * @see ContextDev\Services\ParseService::handle()
 *
 * @phpstan-import-type PdfShape from \ContextDev\Parse\ParseHandleParams\Pdf
 *
 * @phpstan-type ParseHandleParamsShape = array{
 *   extension?: null|Extension|value-of<Extension>,
 *   includeImages?: bool|null,
 *   includeLinks?: bool|null,
 *   ocr?: bool|null,
 *   pdf?: null|Pdf|PdfShape,
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
     * Optional file extension hint. Case-insensitive; a leading dot is accepted (e.g. ".pdf").
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
     * Gates all OCR. When true, PDFs get embedded-image OCR (recognized text inserted at each image's position in page reading order, preserving the text layer; pdf.start/pdf.end limit the page range), scanned PDFs with no text layer get full-document OCR, and raster images get their visible text transcribed. When false, no OCR runs: scanned PDFs may yield no content and images return only format/dimension metadata. Calls where OCR actually runs cost 5 credits instead of 1.
     */
    #[Optional]
    public ?bool $ocr;

    /**
     * PDF page-range controls. Use start/end to limit parsing (and OCR when ocr=true) to an inclusive 1-based page range.
     */
    #[Optional]
    public ?Pdf $pdf;

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
     *
     * @param Extension|value-of<Extension>|null $extension
     * @param Pdf|PdfShape|null $pdf
     */
    public static function with(
        Extension|string|null $extension = null,
        ?bool $includeImages = null,
        ?bool $includeLinks = null,
        ?bool $ocr = null,
        Pdf|array|null $pdf = null,
        ?bool $shortenBase64Images = null,
        ?bool $useMainContentOnly = null,
    ): self {
        $self = new self;

        null !== $extension && $self['extension'] = $extension;
        null !== $includeImages && $self['includeImages'] = $includeImages;
        null !== $includeLinks && $self['includeLinks'] = $includeLinks;
        null !== $ocr && $self['ocr'] = $ocr;
        null !== $pdf && $self['pdf'] = $pdf;
        null !== $shortenBase64Images && $self['shortenBase64Images'] = $shortenBase64Images;
        null !== $useMainContentOnly && $self['useMainContentOnly'] = $useMainContentOnly;

        return $self;
    }

    /**
     * Optional file extension hint. Case-insensitive; a leading dot is accepted (e.g. ".pdf").
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
     * Gates all OCR. When true, PDFs get embedded-image OCR (recognized text inserted at each image's position in page reading order, preserving the text layer; pdf.start/pdf.end limit the page range), scanned PDFs with no text layer get full-document OCR, and raster images get their visible text transcribed. When false, no OCR runs: scanned PDFs may yield no content and images return only format/dimension metadata. Calls where OCR actually runs cost 5 credits instead of 1.
     */
    public function withOcr(bool $ocr): self
    {
        $self = clone $this;
        $self['ocr'] = $ocr;

        return $self;
    }

    /**
     * PDF page-range controls. Use start/end to limit parsing (and OCR when ocr=true) to an inclusive 1-based page range.
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
     * Extract only the main content from HTML-like inputs.
     */
    public function withUseMainContentOnly(bool $useMainContentOnly): self
    {
        $self = clone $this;
        $self['useMainContentOnly'] = $useMainContentOnly;

        return $self;
    }
}
