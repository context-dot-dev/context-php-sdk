<?php

declare(strict_types=1);

namespace ContextDev\Parse\ParseHandleParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * PDF page-range options as a JSON object, e.g. {"start": 2, "end": 5}.
 *
 * @phpstan-type PdfShape = array{end?: int|null, start?: int|null}
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
    public static function with(?int $end = null, ?int $start = null): self
    {
        $self = new self;

        null !== $end && $self['end'] = $end;
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
     * First 1-based PDF page to parse.
     */
    public function withStart(int $start): self
    {
        $self = clone $this;
        $self['start'] = $start;

        return $self;
    }
}
