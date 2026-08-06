<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeMdParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebScrapeMdParams\Pdf\Ocr;
use ContextDev\Web\WebWebScrapeMdParams\Pdf\Ocr\UnionMember1;
use ContextDev\Web\WebWebScrapeMdParams\Pdf\ShouldParse;

/**
 * PDF parsing controls. Use start/end to limit text extraction and embedded-image detection/OCR to an inclusive 1-based page range.
 *
 * @phpstan-import-type OcrVariants from \ContextDev\Web\WebWebScrapeMdParams\Pdf\Ocr
 * @phpstan-import-type ShouldParseVariants from \ContextDev\Web\WebWebScrapeMdParams\Pdf\ShouldParse
 * @phpstan-import-type OcrShape from \ContextDev\Web\WebWebScrapeMdParams\Pdf\Ocr
 * @phpstan-import-type ShouldParseShape from \ContextDev\Web\WebWebScrapeMdParams\Pdf\ShouldParse
 *
 * @phpstan-type PdfShape = array{
 *   end?: int|null,
 *   ocr?: OcrShape|null,
 *   shouldParse?: ShouldParseShape|null,
 *   start?: int|null,
 * }
 */
final class Pdf implements BaseModel
{
    /** @use SdkModel<PdfShape> */
    use SdkModel;

    /**
     * Last 1-based PDF page to parse. When omitted, parsing ends at the last page. Must be greater than or equal to start when both are provided.
     */
    #[Optional]
    public ?int $end;

    /**
     * When true, detect and OCR images embedded in the selected PDF pages, inserting recognized text at each image's position in page reading order while preserving the PDF text layer. When false, no OCR runs.
     *
     * @var OcrVariants|null $ocr
     */
    #[Optional(union: Ocr::class)]
    public bool|string|null $ocr;

    /**
     * When true, PDF URLs are fetched and parsed. When false, PDF URLs are skipped and a 400 PDF_SKIPPED is returned.
     *
     * @var ShouldParseVariants|null $shouldParse
     */
    #[Optional(union: ShouldParse::class)]
    public bool|string|null $shouldParse;

    /**
     * First 1-based PDF page to parse. When omitted, parsing starts at the first page.
     */
    #[Optional]
    public ?int $start;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param OcrShape|null $ocr
     * @param ShouldParseShape|null $shouldParse
     */
    public static function with(
        ?int $end = null,
        bool|UnionMember1|string|null $ocr = null,
        bool|ShouldParse\UnionMember1|string|null $shouldParse = null,
        ?int $start = null,
    ): self {
        $self = new self;

        null !== $end && $self['end'] = $end;
        null !== $ocr && $self['ocr'] = $ocr;
        null !== $shouldParse && $self['shouldParse'] = $shouldParse;
        null !== $start && $self['start'] = $start;

        return $self;
    }

    /**
     * Last 1-based PDF page to parse. When omitted, parsing ends at the last page. Must be greater than or equal to start when both are provided.
     */
    public function withEnd(int $end): self
    {
        $self = clone $this;
        $self['end'] = $end;

        return $self;
    }

    /**
     * When true, detect and OCR images embedded in the selected PDF pages, inserting recognized text at each image's position in page reading order while preserving the PDF text layer. When false, no OCR runs.
     *
     * @param OcrShape $ocr
     */
    public function withOcr(bool|UnionMember1|string $ocr): self
    {
        $self = clone $this;
        $self['ocr'] = $ocr;

        return $self;
    }

    /**
     * When true, PDF URLs are fetched and parsed. When false, PDF URLs are skipped and a 400 PDF_SKIPPED is returned.
     *
     * @param ShouldParseShape $shouldParse
     */
    public function withShouldParse(
        bool|ShouldParse\UnionMember1|string $shouldParse,
    ): self {
        $self = clone $this;
        $self['shouldParse'] = $shouldParse;

        return $self;
    }

    /**
     * First 1-based PDF page to parse. When omitted, parsing starts at the first page.
     */
    public function withStart(int $start): self
    {
        $self = clone $this;
        $self['start'] = $start;

        return $self;
    }
}
