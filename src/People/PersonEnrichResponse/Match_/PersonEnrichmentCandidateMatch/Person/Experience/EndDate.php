<?php

declare(strict_types=1);

namespace ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\Experience;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * When the role ended.
 *
 * @phpstan-type EndDateShape = array{year: int, day?: int|null, month?: int|null}
 */
final class EndDate implements BaseModel
{
    /** @use SdkModel<EndDateShape> */
    use SdkModel;

    /**
     * Four-digit year.
     */
    #[Required]
    public int $year;

    /**
     * Day of the month. Omitted when unknown.
     */
    #[Optional]
    public ?int $day;

    /**
     * Month. Omitted when unknown.
     */
    #[Optional]
    public ?int $month;

    /**
     * `new EndDate()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EndDate::with(year: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EndDate)->withYear(...)
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

    /**
     * Four-digit year.
     */
    public function withYear(int $year): self
    {
        $self = clone $this;
        $self['year'] = $year;

        return $self;
    }

    /**
     * Day of the month. Omitted when unknown.
     */
    public function withDay(int $day): self
    {
        $self = clone $this;
        $self['day'] = $day;

        return $self;
    }

    /**
     * Month. Omitted when unknown.
     */
    public function withMonth(int $month): self
    {
        $self = clone $this;
        $self['month'] = $month;

        return $self;
    }
}
