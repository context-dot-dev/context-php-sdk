<?php

declare(strict_types=1);

namespace ContextDev\People\PersonSearchParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Additional constraints every result must match.
 *
 * @phpstan-type FiltersShape = array{
 *   countries?: list<string>|null,
 *   yearsOfExperienceMax?: int|null,
 *   yearsOfExperienceMin?: int|null,
 * }
 */
final class Filters implements BaseModel
{
    /** @use SdkModel<FiltersShape> */
    use SdkModel;

    /**
     * Countries people live in as two-letter codes, such as US or GB.
     *
     * @var list<string>|null $countries
     */
    #[Optional(list: 'string')]
    public ?array $countries;

    /**
     * Maximum years of professional experience.
     */
    #[Optional('years_of_experience_max')]
    public ?int $yearsOfExperienceMax;

    /**
     * Minimum years of professional experience.
     */
    #[Optional('years_of_experience_min')]
    public ?int $yearsOfExperienceMin;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $countries
     */
    public static function with(
        ?array $countries = null,
        ?int $yearsOfExperienceMax = null,
        ?int $yearsOfExperienceMin = null,
    ): self {
        $self = new self;

        null !== $countries && $self['countries'] = $countries;
        null !== $yearsOfExperienceMax && $self['yearsOfExperienceMax'] = $yearsOfExperienceMax;
        null !== $yearsOfExperienceMin && $self['yearsOfExperienceMin'] = $yearsOfExperienceMin;

        return $self;
    }

    /**
     * Countries people live in as two-letter codes, such as US or GB.
     *
     * @param list<string> $countries
     */
    public function withCountries(array $countries): self
    {
        $self = clone $this;
        $self['countries'] = $countries;

        return $self;
    }

    /**
     * Maximum years of professional experience.
     */
    public function withYearsOfExperienceMax(int $yearsOfExperienceMax): self
    {
        $self = clone $this;
        $self['yearsOfExperienceMax'] = $yearsOfExperienceMax;

        return $self;
    }

    /**
     * Minimum years of professional experience.
     */
    public function withYearsOfExperienceMin(int $yearsOfExperienceMin): self
    {
        $self = clone $this;
        $self['yearsOfExperienceMin'] = $yearsOfExperienceMin;

        return $self;
    }
}
