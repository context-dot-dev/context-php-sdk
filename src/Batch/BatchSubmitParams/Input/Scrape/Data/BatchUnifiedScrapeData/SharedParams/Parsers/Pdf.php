<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\SharedParams\Parsers;

use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\SharedParams\Parsers\Pdf\Ocr;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * PDF page range and OCR.
 *
 * @phpstan-type PdfShape = array{
 *   endPage?: int|null,
 *   includeNumberedPages?: bool|null,
 *   ocr?: null|Ocr|value-of<Ocr>,
 *   startPage?: int|null,
 * }
 */
final class Pdf implements BaseModel
{
    /** @use SdkModel<PdfShape> */
    use SdkModel;

    /**
     * Last page to parse. Must be at least `startPage`.
     */
    #[Optional]
    public ?int $endPage;

    /**
     * Start each page in the Markdown with a `<!-- page N -->` line using its original 1-based page number; these responses are never served from cache.
     */
    #[Optional]
    public ?bool $includeNumberedPages;

    /**
     * Set `auto` to read scanned pages with OCR.
     *
     * @var value-of<Ocr>|null $ocr
     */
    #[Optional(enum: Ocr::class)]
    public ?string $ocr;

    /**
     * First page to parse, starting at 1.
     */
    #[Optional]
    public ?int $startPage;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Ocr|value-of<Ocr>|null $ocr
     */
    public static function with(
        ?int $endPage = null,
        ?bool $includeNumberedPages = null,
        Ocr|string|null $ocr = null,
        ?int $startPage = null,
    ): self {
        $self = new self;

        null !== $endPage && $self['endPage'] = $endPage;
        null !== $includeNumberedPages && $self['includeNumberedPages'] = $includeNumberedPages;
        null !== $ocr && $self['ocr'] = $ocr;
        null !== $startPage && $self['startPage'] = $startPage;

        return $self;
    }

    /**
     * Last page to parse. Must be at least `startPage`.
     */
    public function withEndPage(int $endPage): self
    {
        $self = clone $this;
        $self['endPage'] = $endPage;

        return $self;
    }

    /**
     * Start each page in the Markdown with a `<!-- page N -->` line using its original 1-based page number; these responses are never served from cache.
     */
    public function withIncludeNumberedPages(bool $includeNumberedPages): self
    {
        $self = clone $this;
        $self['includeNumberedPages'] = $includeNumberedPages;

        return $self;
    }

    /**
     * Set `auto` to read scanned pages with OCR.
     *
     * @param Ocr|value-of<Ocr> $ocr
     */
    public function withOcr(Ocr|string $ocr): self
    {
        $self = clone $this;
        $self['ocr'] = $ocr;

        return $self;
    }

    /**
     * First page to parse, starting at 1.
     */
    public function withStartPage(int $startPage): self
    {
        $self = clone $this;
        $self['startPage'] = $startPage;

        return $self;
    }
}
