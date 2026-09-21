<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\SharedParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScrapeParams\SharedParams\Parsers\Pdf;

/**
 * Document parsing options.
 *
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebScrapeParams\SharedParams\Parsers\Pdf
 *
 * @phpstan-type ParsersShape = array{pdf?: null|Pdf|PdfShape}
 */
final class Parsers implements BaseModel
{
    /** @use SdkModel<ParsersShape> */
    use SdkModel;

    /**
     * PDF text options for HTML, Markdown, and parsed fields.
     */
    #[Optional]
    public ?Pdf $pdf;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Pdf|PdfShape|null $pdf
     */
    public static function with(Pdf|array|null $pdf = null): self
    {
        $self = new self;

        null !== $pdf && $self['pdf'] = $pdf;

        return $self;
    }

    /**
     * PDF text options for HTML, Markdown, and parsed fields.
     *
     * @param Pdf|PdfShape $pdf
     */
    public function withPdf(Pdf|array $pdf): self
    {
        $self = clone $this;
        $self['pdf'] = $pdf;

        return $self;
    }
}
