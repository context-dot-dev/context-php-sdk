<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitResponse\Person\Education;

use ContextDev\Batch\BatchSubmitResponse\Person\Education\Dates\EndDate;
use ContextDev\Batch\BatchSubmitResponse\Person\Education\Dates\StartDate;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Education dates.
 *
 * @phpstan-import-type EndDateShape from \ContextDev\Batch\BatchSubmitResponse\Person\Education\Dates\EndDate
 * @phpstan-import-type StartDateShape from \ContextDev\Batch\BatchSubmitResponse\Person\Education\Dates\StartDate
 *
 * @phpstan-type DatesShape = array{
 *   endDate?: null|EndDate|EndDateShape,
 *   isCurrent?: bool|null,
 *   startDate?: null|StartDate|StartDateShape,
 * }
 */
final class Dates implements BaseModel
{
    /** @use SdkModel<DatesShape> */
    use SdkModel;

    /**
     * End date, when known.
     */
    #[Optional]
    public ?EndDate $endDate;

    /**
     * Whether the entry is current.
     */
    #[Optional]
    public ?bool $isCurrent;

    /**
     * Start date, when known.
     */
    #[Optional]
    public ?StartDate $startDate;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param EndDate|EndDateShape|null $endDate
     * @param StartDate|StartDateShape|null $startDate
     */
    public static function with(
        EndDate|array|null $endDate = null,
        ?bool $isCurrent = null,
        StartDate|array|null $startDate = null,
    ): self {
        $self = new self;

        null !== $endDate && $self['endDate'] = $endDate;
        null !== $isCurrent && $self['isCurrent'] = $isCurrent;
        null !== $startDate && $self['startDate'] = $startDate;

        return $self;
    }

    /**
     * End date, when known.
     *
     * @param EndDate|EndDateShape $endDate
     */
    public function withEndDate(EndDate|array $endDate): self
    {
        $self = clone $this;
        $self['endDate'] = $endDate;

        return $self;
    }

    /**
     * Whether the entry is current.
     */
    public function withIsCurrent(bool $isCurrent): self
    {
        $self = clone $this;
        $self['isCurrent'] = $isCurrent;

        return $self;
    }

    /**
     * Start date, when known.
     *
     * @param StartDate|StartDateShape $startDate
     */
    public function withStartDate(StartDate|array $startDate): self
    {
        $self = clone $this;
        $self['startDate'] = $startDate;

        return $self;
    }
}
