<?php

declare(strict_types=1);

namespace ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\CurrentRole\EndDate;
use ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\CurrentRole\Organization;
use ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\CurrentRole\StartDate;

/**
 * The person's current job. See `current_role_status` when it is missing.
 *
 * @phpstan-import-type OrganizationShape from \ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\CurrentRole\Organization
 * @phpstan-import-type EndDateShape from \ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\CurrentRole\EndDate
 * @phpstan-import-type StartDateShape from \ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\CurrentRole\StartDate
 *
 * @phpstan-type CurrentRoleShape = array{
 *   organization: Organization|OrganizationShape,
 *   title: string,
 *   description?: string|null,
 *   endDate?: null|EndDate|EndDateShape,
 *   isCurrent?: bool|null,
 *   location?: string|null,
 *   startDate?: null|StartDate|StartDateShape,
 * }
 */
final class CurrentRole implements BaseModel
{
    /** @use SdkModel<CurrentRoleShape> */
    use SdkModel;

    /**
     * Employer for this role.
     */
    #[Required]
    public Organization $organization;

    /**
     * Job title.
     */
    #[Required]
    public string $title;

    /**
     * Description of the role.
     */
    #[Optional]
    public ?string $description;

    /**
     * When the role ended.
     */
    #[Optional('end_date')]
    public ?EndDate $endDate;

    /**
     * Whether the person still holds this role.
     */
    #[Optional('is_current')]
    public ?bool $isCurrent;

    /**
     * Where the role is based.
     */
    #[Optional]
    public ?string $location;

    /**
     * When the role started.
     */
    #[Optional('start_date')]
    public ?StartDate $startDate;

    /**
     * `new CurrentRole()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CurrentRole::with(organization: ..., title: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CurrentRole)->withOrganization(...)->withTitle(...)
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
     * Employer for this role.
     *
     * @param Organization|OrganizationShape $organization
     */
    public function withOrganization(Organization|array $organization): self
    {
        $self = clone $this;
        $self['organization'] = $organization;

        return $self;
    }

    /**
     * Job title.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * Description of the role.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * When the role ended.
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
     * Whether the person still holds this role.
     */
    public function withIsCurrent(bool $isCurrent): self
    {
        $self = clone $this;
        $self['isCurrent'] = $isCurrent;

        return $self;
    }

    /**
     * Where the role is based.
     */
    public function withLocation(string $location): self
    {
        $self = clone $this;
        $self['location'] = $location;

        return $self;
    }

    /**
     * When the role started.
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
