<?php

declare(strict_types=1);

namespace ContextDev\Scholar\ScholarSearchParams\FilterBy;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Publication date range. Undated papers are excluded.
 *
 * @phpstan-type DateShape = array{from?: int|null, to?: int|null}
 */
final class Date implements BaseModel
{
    /** @use SdkModel<DateShape> */
    use SdkModel;

    /**
     * Inclusive start date, in Unix milliseconds.
     */
    #[Optional]
    public ?int $from;

    /**
     * Inclusive end date, in Unix milliseconds.
     */
    #[Optional]
    public ?int $to;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?int $from = null, ?int $to = null): self
    {
        $self = new self;

        null !== $from && $self['from'] = $from;
        null !== $to && $self['to'] = $to;

        return $self;
    }

    /**
     * Inclusive start date, in Unix milliseconds.
     */
    public function withFrom(int $from): self
    {
        $self = clone $this;
        $self['from'] = $from;

        return $self;
    }

    /**
     * Inclusive end date, in Unix milliseconds.
     */
    public function withTo(int $to): self
    {
        $self = clone $this;
        $self['to'] = $to;

        return $self;
    }
}
