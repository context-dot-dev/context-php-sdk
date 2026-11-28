<?php

declare(strict_types=1);

namespace ContextDev\Web\WebSearchParams\MarkdownOptions;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Whether to parse PDFs and which pages to read.
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
     * Last page to parse. Defaults to the last page. Must be at least `start`.
     */
    #[Optional]
    public ?int $end;

    /**
     * Parse PDF results. When `false`, PDF results fail with `WEBSITE_ACCESS_ERROR`.
     */
    #[Optional]
    public ?bool $shouldParse;

    /**
     * First page to parse, starting at 1.
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
     * Last page to parse. Defaults to the last page. Must be at least `start`.
     */
    public function withEnd(int $end): self
    {
        $self = clone $this;
        $self['end'] = $end;

        return $self;
    }

    /**
     * Parse PDF results. When `false`, PDF results fail with `WEBSITE_ACCESS_ERROR`.
     */
    public function withShouldParse(bool $shouldParse): self
    {
        $self = clone $this;
        $self['shouldParse'] = $shouldParse;

        return $self;
    }

    /**
     * First page to parse, starting at 1.
     */
    public function withStart(int $start): self
    {
        $self = clone $this;
        $self['start'] = $start;

        return $self;
    }
}
