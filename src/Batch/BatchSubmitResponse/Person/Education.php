<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitResponse\Person;

use ContextDev\Batch\BatchSubmitResponse\Person\Education\Dates;
use ContextDev\Batch\BatchSubmitResponse\Person\Education\Institution;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type InstitutionShape from \ContextDev\Batch\BatchSubmitResponse\Person\Education\Institution
 * @phpstan-import-type DatesShape from \ContextDev\Batch\BatchSubmitResponse\Person\Education\Dates
 *
 * @phpstan-type EducationShape = array{
 *   institution: Institution|InstitutionShape,
 *   dates?: null|Dates|DatesShape,
 *   description?: string|null,
 *   fieldOfStudy?: string|null,
 *   qualification?: string|null,
 * }
 */
final class Education implements BaseModel
{
    /** @use SdkModel<EducationShape> */
    use SdkModel;

    /**
     * School or institution name.
     */
    #[Required]
    public Institution $institution;

    /**
     * Education dates.
     */
    #[Optional]
    public ?Dates $dates;

    /**
     * Additional education details.
     */
    #[Optional]
    public ?string $description;

    /**
     * Area of study.
     */
    #[Optional]
    public ?string $fieldOfStudy;

    /**
     * Degree, certificate, or credential.
     */
    #[Optional]
    public ?string $qualification;

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
     * @param Dates|DatesShape|null $dates
     */
    public static function with(
        Institution|array $institution,
        Dates|array|null $dates = null,
        ?string $description = null,
        ?string $fieldOfStudy = null,
        ?string $qualification = null,
    ): self {
        $self = new self;

        $self['institution'] = $institution;

        null !== $dates && $self['dates'] = $dates;
        null !== $description && $self['description'] = $description;
        null !== $fieldOfStudy && $self['fieldOfStudy'] = $fieldOfStudy;
        null !== $qualification && $self['qualification'] = $qualification;

        return $self;
    }

    /**
     * School or institution name.
     *
     * @param Institution|InstitutionShape $institution
     */
    public function withInstitution(Institution|array $institution): self
    {
        $self = clone $this;
        $self['institution'] = $institution;

        return $self;
    }

    /**
     * Education dates.
     *
     * @param Dates|DatesShape $dates
     */
    public function withDates(Dates|array $dates): self
    {
        $self = clone $this;
        $self['dates'] = $dates;

        return $self;
    }

    /**
     * Additional education details.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Area of study.
     */
    public function withFieldOfStudy(string $fieldOfStudy): self
    {
        $self = clone $this;
        $self['fieldOfStudy'] = $fieldOfStudy;

        return $self;
    }

    /**
     * Degree, certificate, or credential.
     */
    public function withQualification(string $qualification): self
    {
        $self = clone $this;
        $self['qualification'] = $qualification;

        return $self;
    }
}
