<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeMdParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * PDF parsing controls. Use start/end to limit text extraction and embedded-image detection/OCR to an inclusive 1-based page range.
 *
 * @phpstan-type PdfShape = array{
 *   end?: int|null, ocr?: bool|null, shouldParse?: bool|null, start?: int|null
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
     * When true, OCR the selected PDF pages that have no usable text layer (scans), replacing each recovered page's text with the OCR result while pages with a real text layer keep it. Billed at 1 credit per page OCR actually recovered, on top of the base request cost. When false, no OCR runs.
     */
    #[Optional]
    public ?bool $ocr;

    /**
     * When true, PDF URLs are fetched and parsed. When false, PDF URLs are skipped and a 400 PDF_SKIPPED is returned.
     */
    #[Optional]
    public ?bool $shouldParse;

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
     */
    public static function with(
        ?int $end = null,
        ?bool $ocr = null,
        ?bool $shouldParse = null,
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
     * When true, OCR the selected PDF pages that have no usable text layer (scans), replacing each recovered page's text with the OCR result while pages with a real text layer keep it. Billed at 1 credit per page OCR actually recovered, on top of the base request cost. When false, no OCR runs.
     */
    public function withOcr(bool $ocr): self
    {
        $self = clone $this;
        $self['ocr'] = $ocr;

        return $self;
    }

    /**
     * When true, PDF URLs are fetched and parsed. When false, PDF URLs are skipped and a 400 PDF_SKIPPED is returned.
     */
    public function withShouldParse(bool $shouldParse): self
    {
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
