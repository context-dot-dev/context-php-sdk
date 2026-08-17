<?php

declare(strict_types=1);

namespace ContextDev\News\NewsSearchParams\FilterBy;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Published-at window in epoch milliseconds.
 *
 * @phpstan-type DateShape = array{from?: int|null, to?: int|null}
 */
final class Date implements BaseModel
{
    /** @use SdkModel<DateShape> */
    use SdkModel;

    /**
     * Inclusive start of the published-at window, in epoch milliseconds.
     */
    #[Optional]
    public ?int $from;

    /**
     * Inclusive end of the published-at window, in epoch milliseconds.
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
     * Inclusive start of the published-at window, in epoch milliseconds.
     */
    public function withFrom(int $from): self
    {
        $self = clone $this;
        $self['from'] = $from;

        return $self;
    }

    /**
     * Inclusive end of the published-at window, in epoch milliseconds.
     */
    public function withTo(int $to): self
    {
        $self = clone $this;
        $self['to'] = $to;

        return $self;
    }
}
