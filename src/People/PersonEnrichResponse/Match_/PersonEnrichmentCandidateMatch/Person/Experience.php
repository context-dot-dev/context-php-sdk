<?php

declare(strict_types=1);

namespace ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\Experience\EndDate;
use ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\Experience\Organization;
use ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\Experience\StartDate;

/**
 * @phpstan-import-type OrganizationShape from \ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\Experience\Organization
 * @phpstan-import-type EndDateShape from \ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\Experience\EndDate
 * @phpstan-import-type StartDateShape from \ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\Experience\StartDate
 *
 * @phpstan-type ExperienceShape = array{
 *   organization: Organization|OrganizationShape,
 *   title: string,
 *   description?: string|null,
 *   endDate?: null|EndDate|EndDateShape,
 *   isCurrent?: bool|null,
 *   location?: string|null,
 *   startDate?: null|StartDate|StartDateShape,
 * }
 */
final class Experience implements BaseModel
{
    /** @use SdkModel<ExperienceShape> */
    use SdkModel;

    #[Required]
    public Organization $organization;

    #[Required]
    public string $title;

    #[Optional]
    public ?string $description;

    #[Optional('end_date')]
    public ?EndDate $endDate;

    #[Optional('is_current')]
    public ?bool $isCurrent;

    #[Optional]
    public ?string $location;

    #[Optional('start_date')]
    public ?StartDate $startDate;

    /**
     * `new Experience()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Experience::with(organization: ..., title: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Experience)->withOrganization(...)->withTitle(...)
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
     * @param Organization|OrganizationShape $organization
     * @param EndDate|EndDateShape|null $endDate
     * @param StartDate|StartDateShape|null $startDate
     */
    public static function with(
        Organization|array $organization,
        string $title,
        ?string $description = null,
        EndDate|array|null $endDate = null,
        ?bool $isCurrent = null,
        ?string $location = null,
        StartDate|array|null $startDate = null,
    ): self {
        $self = new self;

        $self['organization'] = $organization;
        $self['title'] = $title;

        null !== $description && $self['description'] = $description;
        null !== $endDate && $self['endDate'] = $endDate;
        null !== $isCurrent && $self['isCurrent'] = $isCurrent;
        null !== $location && $self['location'] = $location;
        null !== $startDate && $self['startDate'] = $startDate;

        return $self;
    }

    /**
     * @param Organization|OrganizationShape $organization
     */
    public function withOrganization(Organization|array $organization): self
    {
        $self = clone $this;
        $self['organization'] = $organization;

        return $self;
    }

    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

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

    public function withIsCurrent(bool $isCurrent): self
    {
        $self = clone $this;
        $self['isCurrent'] = $isCurrent;

        return $self;
    }

    public function withLocation(string $location): self
    {
        $self = clone $this;
        $self['location'] = $location;

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
