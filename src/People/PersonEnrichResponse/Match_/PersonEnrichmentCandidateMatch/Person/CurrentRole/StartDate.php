<?php

declare(strict_types=1);

namespace ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\CurrentRole;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type StartDateShape = array{
 *   year: int, day?: int|null, month?: int|null
 * }
 */
final class StartDate implements BaseModel
{
    /** @use SdkModel<StartDateShape> */
    use SdkModel;

    #[Required]
    public int $year;

    #[Optional]
    public ?int $day;

    #[Optional]
    public ?int $month;

    /**
     * `new StartDate()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StartDate::with(year: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StartDate)->withYear(...)
     * ```
     */
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
        int $year,
        ?int $day = null,
        ?int $month = null
    ): self {
        $self = new self;

        $self['year'] = $year;

        null !== $day && $self['day'] = $day;
        null !== $month && $self['month'] = $month;

        return $self;
    }

    public function withYear(int $year): self
    {
        $self = clone $this;
        $self['year'] = $year;

        return $self;
    }

    public function withDay(int $day): self
    {
        $self = clone $this;
        $self['day'] = $day;

        return $self;
    }

    public function withMonth(int $month): self
    {
        $self = clone $this;
        $self['month'] = $month;

        return $self;
    }
}
