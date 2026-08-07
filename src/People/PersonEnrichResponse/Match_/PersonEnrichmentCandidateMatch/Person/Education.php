<?php

declare(strict_types=1);

namespace ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\Education\EndDate;
use ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\Education\Institution;
use ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\Education\StartDate;

/**
 * @phpstan-import-type InstitutionShape from \ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\Education\Institution
 * @phpstan-import-type EndDateShape from \ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\Education\EndDate
 * @phpstan-import-type StartDateShape from \ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\Education\StartDate
 *
 * @phpstan-type EducationShape = array{
 *   institution: Institution|InstitutionShape,
 *   degree?: string|null,
 *   description?: string|null,
 *   endDate?: null|EndDate|EndDateShape,
 *   fieldOfStudy?: string|null,
 *   startDate?: null|StartDate|StartDateShape,
 * }
 */
final class Education implements BaseModel
{
    /** @use SdkModel<EducationShape> */
    use SdkModel;

    #[Required]
    public Institution $institution;

    #[Optional]
    public ?string $degree;

    #[Optional]
    public ?string $description;

    #[Optional('end_date')]
    public ?EndDate $endDate;

    #[Optional('field_of_study')]
    public ?string $fieldOfStudy;

    #[Optional('start_date')]
    public ?StartDate $startDate;

    /**
     * `new Education()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Education::with(institution: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Education)->withInstitution(...)
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
     *
     * @param Institution|InstitutionShape $institution
     * @param EndDate|EndDateShape|null $endDate
     * @param StartDate|StartDateShape|null $startDate
     */
    public static function with(
        Institution|array $institution,
        ?string $degree = null,
        ?string $description = null,
        EndDate|array|null $endDate = null,
        ?string $fieldOfStudy = null,
        StartDate|array|null $startDate = null,
    ): self {
        $self = new self;

        $self['institution'] = $institution;

        null !== $degree && $self['degree'] = $degree;
        null !== $description && $self['description'] = $description;
        null !== $endDate && $self['endDate'] = $endDate;
        null !== $fieldOfStudy && $self['fieldOfStudy'] = $fieldOfStudy;
        null !== $startDate && $self['startDate'] = $startDate;

        return $self;
    }

    /**
     * @param Institution|InstitutionShape $institution
     */
    public function withInstitution(Institution|array $institution): self
    {
        $self = clone $this;
        $self['institution'] = $institution;

        return $self;
    }

    public function withDegree(string $degree): self
    {
        $self = clone $this;
        $self['degree'] = $degree;

        return $self;
    }

    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * @param EndDate|EndDateShape $endDate
     */
    public function withEndDate(EndDate|array $endDate): self
    {
        $self = clone $this;
        $self['endDate'] = $endDate;

        return $self;
    }

    public function withFieldOfStudy(string $fieldOfStudy): self
    {
        $self = clone $this;
        $self['fieldOfStudy'] = $fieldOfStudy;

        return $self;
    }

    /**
     * @param StartDate|StartDateShape $startDate
     */
    public function withStartDate(StartDate|array $startDate): self
    {
        $self = clone $this;
        $self['startDate'] = $startDate;

        return $self;
    }
}
