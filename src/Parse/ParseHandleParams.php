<?php

declare(strict_types=1);

namespace ContextDev\Parse;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Parse\ParseHandleParams\Extension;
use ContextDev\Parse\ParseHandleParams\IncludeImages;
use ContextDev\Parse\ParseHandleParams\IncludeImages\UnionMember1;
use ContextDev\Parse\ParseHandleParams\IncludeLinks;
use ContextDev\Parse\ParseHandleParams\Ocr;
use ContextDev\Parse\ParseHandleParams\Pdf;
use ContextDev\Parse\ParseHandleParams\ShortenBase64Images;
use ContextDev\Parse\ParseHandleParams\UseMainContentOnly;
use ContextDev\Parse\ParseHandleParams\Zdr;

/**
 * Converts raw text, source code, web/data, PDF, Microsoft Office, and image bytes into LLM-usable Markdown.
 *
 * @see ContextDev\Services\ParseService::handle()
 *
 * @phpstan-import-type IncludeImagesVariants from \ContextDev\Parse\ParseHandleParams\IncludeImages
 * @phpstan-import-type IncludeLinksVariants from \ContextDev\Parse\ParseHandleParams\IncludeLinks
 * @phpstan-import-type OcrVariants from \ContextDev\Parse\ParseHandleParams\Ocr
 * @phpstan-import-type ShortenBase64ImagesVariants from \ContextDev\Parse\ParseHandleParams\ShortenBase64Images
 * @phpstan-import-type UseMainContentOnlyVariants from \ContextDev\Parse\ParseHandleParams\UseMainContentOnly
 * @phpstan-import-type IncludeImagesShape from \ContextDev\Parse\ParseHandleParams\IncludeImages
 * @phpstan-import-type IncludeLinksShape from \ContextDev\Parse\ParseHandleParams\IncludeLinks
 * @phpstan-import-type OcrShape from \ContextDev\Parse\ParseHandleParams\Ocr
 * @phpstan-import-type PdfShape from \ContextDev\Parse\ParseHandleParams\Pdf
 * @phpstan-import-type ShortenBase64ImagesShape from \ContextDev\Parse\ParseHandleParams\ShortenBase64Images
 * @phpstan-import-type UseMainContentOnlyShape from \ContextDev\Parse\ParseHandleParams\UseMainContentOnly
 *
 * @phpstan-type ParseHandleParamsShape = array{
 *   client?: string|null,
 *   extension?: null|Extension|value-of<Extension>,
 *   includeImages?: IncludeImagesShape|null,
 *   includeLinks?: IncludeLinksShape|null,
 *   ocr?: OcrShape|null,
 *   pdf?: null|Pdf|PdfShape,
 *   shortenBase64Images?: ShortenBase64ImagesShape|null,
 *   tags?: list<string>|null,
 *   useMainContentOnly?: UseMainContentOnlyShape|null,
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
     * When true for PDF inputs, detect and OCR images embedded in the selected pages, inserting recognized text at each image's position in page reading order while preserving the PDF text layer. pdf.start/pdf.end limit the inclusive page range. When false, no OCR runs.
     *
     * @var OcrVariants|null $ocr
     */
    #[Optional(union: Ocr::class)]
    public bool|string|null $ocr;

    /**
     * PDF page-range options as a JSON object, e.g. {"start": 2, "end": 5}.
     */
    #[Optional]
    public ?Pdf $pdf;

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
     * Extract only the main content from HTML-like inputs.
     *
     * @var UseMainContentOnlyVariants|null $useMainContentOnly
     */
    #[Optional(union: UseMainContentOnly::class)]
    public bool|string|null $useMainContentOnly;

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
     * @param IncludeImagesShape|null $includeImages
     * @param IncludeLinksShape|null $includeLinks
     * @param OcrShape|null $ocr
     * @param Pdf|PdfShape|null $pdf
     * @param ShortenBase64ImagesShape|null $shortenBase64Images
     * @param list<string>|null $tags
     * @param UseMainContentOnlyShape|null $useMainContentOnly
     * @param Zdr|value-of<Zdr>|null $zdr
     */
    public static function with(
        ?string $client = null,
        Extension|string|null $extension = null,
        bool|UnionMember1|string|null $includeImages = null,
        bool|IncludeLinks\UnionMember1|string|null $includeLinks = null,
        bool|Ocr\UnionMember1|string|null $ocr = null,
        Pdf|array|null $pdf = null,
        bool|ShortenBase64Images\UnionMember1|string|null $shortenBase64Images = null,
        ?array $tags = null,
        bool|UseMainContentOnly\UnionMember1|string|null $useMainContentOnly = null,
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
     *
     * @param IncludeImagesShape $includeImages
     */
    public function withIncludeImages(
        bool|UnionMember1|string $includeImages
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
     * When true for PDF inputs, detect and OCR images embedded in the selected pages, inserting recognized text at each image's position in page reading order while preserving the PDF text layer. pdf.start/pdf.end limit the inclusive page range. When false, no OCR runs.
     *
     * @param OcrShape $ocr
     */
    public function withOcr(
        bool|Ocr\UnionMember1|string $ocr
    ): self {
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
     * Extract only the main content from HTML-like inputs.
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
