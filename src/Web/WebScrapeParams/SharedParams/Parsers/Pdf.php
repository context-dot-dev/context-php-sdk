<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\SharedParams\Parsers;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScrapeParams\SharedParams\Parsers\Pdf\Ocr;

/**
 * PDF text options for HTML, Markdown, and parsed fields.
 *
 * @phpstan-type PdfShape = array{
 *   endPage?: int|null, ocr?: null|Ocr|value-of<Ocr>, startPage?: int|null
 * }
 */
final class Pdf implements BaseModel
{
    /** @use SdkModel<PdfShape> */
    use SdkModel;

    /**
     * Last page to parse. Must be at least startPage.
     */
    #[Optional]
    public ?int $endPage;

    /**
     * Read text from scanned pages.
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
        Ocr|string|null $ocr = null,
        ?int $startPage = null
    ): self {
        $self = new self;

        null !== $endPage && $self['endPage'] = $endPage;
        null !== $ocr && $self['ocr'] = $ocr;
        null !== $startPage && $self['startPage'] = $startPage;

        return $self;
    }

    /**
     * Last page to parse. Must be at least startPage.
     */
    public function withEndPage(int $endPage): self
    {
        $self = clone $this;
        $self['endPage'] = $endPage;

        return $self;
    }

    /**
     * Read text from scanned pages.
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
