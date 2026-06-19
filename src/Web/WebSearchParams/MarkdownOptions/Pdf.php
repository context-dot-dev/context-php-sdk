<?php

declare(strict_types=1);

namespace ContextDev\Web\WebSearchParams\MarkdownOptions;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * PDF handling. Use start/end to bound text extraction and OCR to a page range.
 *
 * @phpstan-type PdfShape = array{
 *   end?: int|null, shouldParse?: bool|null, start?: int|null
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
     * Parse PDF URLs. When false, PDF results are skipped with WEBSITE_ACCESS_ERROR.
     */
    #[Optional]
    public ?bool $shouldParse;

    /**
     * First PDF page to parse (1-based, inclusive). Defaults to page 1.
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
        ?bool $shouldParse = null,
        ?int $start = null
    ): self {
        $self = new self;

        null !== $end && $self['end'] = $end;
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
     * Parse PDF URLs. When false, PDF results are skipped with WEBSITE_ACCESS_ERROR.
     */
    public function withShouldParse(bool $shouldParse): self
    {
        $self = clone $this;
        $self['shouldParse'] = $shouldParse;

        return $self;
    }

    /**
     * First PDF page to parse (1-based, inclusive). Defaults to page 1.
     */
    public function withStart(int $start): self
    {
        $self = clone $this;
        $self['start'] = $start;

        return $self;
    }
}
