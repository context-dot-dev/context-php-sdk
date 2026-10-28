<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\Markdown\Options;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * PDF handling. `start`/`end` limit parsing to an inclusive, 1-based page range.
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
     * Last PDF page to parse (1-based, inclusive). Defaults to the final page. Must be >= start.
     */
    #[Optional]
    public ?int $end;

    /**
     * Read scanned PDF pages with OCR; preserve pages that already have text.
     */
    #[Optional]
    public ?bool $ocr;

    /**
     * Parse PDF URLs. When false, PDFs fail with `PDF_SKIPPED`.
     */
    #[Optional]
    public ?bool $shouldParse;

    /**
     * First 1-based PDF page to parse.
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
     * Last PDF page to parse (1-based, inclusive). Defaults to the final page. Must be >= start.
     */
    public function withEnd(int $end): self
    {
        $self = clone $this;
        $self['end'] = $end;

        return $self;
    }

    /**
     * Read scanned PDF pages with OCR; preserve pages that already have text.
     */
    public function withOcr(bool $ocr): self
    {
        $self = clone $this;
        $self['ocr'] = $ocr;

        return $self;
    }

    /**
     * Parse PDF URLs. When false, PDFs fail with `PDF_SKIPPED`.
     */
    public function withShouldParse(bool $shouldParse): self
    {
        $self = clone $this;
        $self['shouldParse'] = $shouldParse;

        return $self;
    }

    /**
     * First 1-based PDF page to parse.
     */
    public function withStart(int $start): self
    {
        $self = clone $this;
        $self['start'] = $start;

        return $self;
    }
}
