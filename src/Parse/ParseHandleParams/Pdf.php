<?php

declare(strict_types=1);

namespace ContextDev\Parse\ParseHandleParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * PDF page range as a JSON object, such as `{"start": 2, "end": 5}`.
 *
 * @phpstan-type PdfShape = array{end?: int|null, start?: int|null}
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
    public static function with(?int $end = null, ?int $start = null): self
    {
        $self = new self;

        null !== $end && $self['end'] = $end;
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
     * First page to parse, starting at 1.
     */
    public function withStart(int $start): self
    {
        $self = clone $this;
        $self['start'] = $start;

        return $self;
    }
}
