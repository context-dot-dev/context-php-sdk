<?php

declare(strict_types=1);

namespace ContextDev\People\PersonEnrichParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\People\PersonEnrichParams\Education\Institution;

/**
 * @phpstan-import-type InstitutionShape from \ContextDev\People\PersonEnrichParams\Education\Institution
 *
 * @phpstan-type EducationShape = array{
 *   degree?: string|null,
 *   fieldOfStudy?: string|null,
 *   graduationYear?: int|null,
 *   institution?: null|Institution|InstitutionShape,
 * }
 */
final class Education implements BaseModel
{
    /** @use SdkModel<EducationShape> */
    use SdkModel;

    #[Optional]
    public ?string $degree;

    #[Optional('field_of_study')]
    public ?string $fieldOfStudy;

    #[Optional('graduation_year')]
    public ?int $graduationYear;

    #[Optional]
    public ?Institution $institution;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Institution|InstitutionShape|null $institution
     */
    public static function with(
        ?string $degree = null,
        ?string $fieldOfStudy = null,
        ?int $graduationYear = null,
        Institution|array|null $institution = null,
    ): self {
        $self = new self;

        null !== $degree && $self['degree'] = $degree;
        null !== $fieldOfStudy && $self['fieldOfStudy'] = $fieldOfStudy;
        null !== $graduationYear && $self['graduationYear'] = $graduationYear;
        null !== $institution && $self['institution'] = $institution;

        return $self;
    }

    public function withDegree(string $degree): self
    {
        $self = clone $this;
        $self['degree'] = $degree;

        return $self;
    }

    public function withFieldOfStudy(string $fieldOfStudy): self
    {
        $self = clone $this;
        $self['fieldOfStudy'] = $fieldOfStudy;

        return $self;
    }

    public function withGraduationYear(int $graduationYear): self
    {
        $self = clone $this;
        $self['graduationYear'] = $graduationYear;

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
}
