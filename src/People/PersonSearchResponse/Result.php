<?php

declare(strict_types=1);

namespace ContextDev\People\PersonSearchResponse;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\People\PersonSearchResponse\Result\Location;
use ContextDev\People\PersonSearchResponse\Result\Match_;
use ContextDev\People\PersonSearchResponse\Result\Role;

/**
 * A person matching your search; unavailable details are null or empty lists.
 *
 * @phpstan-import-type LocationShape from \ContextDev\People\PersonSearchResponse\Result\Location
 * @phpstan-import-type RoleShape from \ContextDev\People\PersonSearchResponse\Result\Role
 * @phpstan-import-type MatchShape from \ContextDev\People\PersonSearchResponse\Result\Match_
 *
 * @phpstan-type ResultShape = array{
 *   description: string|null,
 *   isFounder: bool|null,
 *   location: Location|LocationShape,
 *   name: string|null,
 *   profiles: list<string>,
 *   role: Role|RoleShape,
 *   schools: list<string>,
 *   skills: list<string>,
 *   yearsOfExperience: int|null,
 *   match?: null|Match_|MatchShape,
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    /**
     * What the person does.
     */
    #[Required]
    public ?string $description;

    /**
     * Whether the person is currently a founder or co-founder.
     */
    #[Required('is_founder')]
    public ?bool $isFounder;

    /**
     * Where the person lives.
     */
    #[Required]
    public Location $location;

    /**
     * Full name.
     */
    #[Required]
    public ?string $name;

    /**
     * Public professional profile URLs.
     *
     * @var list<string> $profiles
     */
    #[Required(list: 'string')]
    public array $profiles;

    /**
     * The person’s current role.
     */
    #[Required]
    public Role $role;

    /**
     * Schools attended.
     *
     * @var list<string> $schools
     */
    #[Required(list: 'string')]
    public array $schools;

    /**
     * Professional skills.
     *
     * @var list<string> $skills
     */
    #[Required(list: 'string')]
    public array $skills;

    /**
     * Years of professional experience.
     */
    #[Required('years_of_experience')]
    public ?int $yearsOfExperience;

    /**
     * How well the person matches the query. Only returned in `ultra` mode.
     */
    #[Optional]
    public ?Match_ $match;

    /**
     * `new Result()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Result::with(
     *   description: ...,
     *   isFounder: ...,
     *   location: ...,
     *   name: ...,
     *   profiles: ...,
     *   role: ...,
     *   schools: ...,
     *   skills: ...,
     *   yearsOfExperience: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Result)
     *   ->withDescription(...)
     *   ->withIsFounder(...)
     *   ->withLocation(...)
     *   ->withName(...)
     *   ->withProfiles(...)
     *   ->withRole(...)
     *   ->withSchools(...)
     *   ->withSkills(...)
     *   ->withYearsOfExperience(...)
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
     * @param Location|LocationShape $location
     * @param list<string> $profiles
     * @param Role|RoleShape $role
     * @param list<string> $schools
     * @param list<string> $skills
     * @param Match_|MatchShape|null $match
     */
    public static function with(
        ?string $description,
        ?bool $isFounder,
        Location|array $location,
        ?string $name,
        array $profiles,
        Role|array $role,
        array $schools,
        array $skills,
        ?int $yearsOfExperience,
        Match_|array|null $match = null,
    ): self {
        $self = new self;

        $self['description'] = $description;
        $self['isFounder'] = $isFounder;
        $self['location'] = $location;
        $self['name'] = $name;
        $self['profiles'] = $profiles;
        $self['role'] = $role;
        $self['schools'] = $schools;
        $self['skills'] = $skills;
        $self['yearsOfExperience'] = $yearsOfExperience;

        null !== $match && $self['match'] = $match;

        return $self;
    }

    /**
     * What the person does.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Whether the person is currently a founder or co-founder.
     */
    public function withIsFounder(?bool $isFounder): self
    {
        $self = clone $this;
        $self['isFounder'] = $isFounder;

        return $self;
    }

    /**
     * Where the person lives.
     *
     * @param Location|LocationShape $location
     */
    public function withLocation(Location|array $location): self
    {
        $self = clone $this;
        $self['location'] = $location;

        return $self;
    }

    /**
     * Full name.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Public professional profile URLs.
     *
     * @param list<string> $profiles
     */
    public function withProfiles(array $profiles): self
    {
        $self = clone $this;
        $self['profiles'] = $profiles;

        return $self;
    }

    /**
     * The person’s current role.
     *
     * @param Role|RoleShape $role
     */
    public function withRole(Role|array $role): self
    {
        $self = clone $this;
        $self['role'] = $role;

        return $self;
    }

    /**
     * Schools attended.
     *
     * @param list<string> $schools
     */
    public function withSchools(array $schools): self
    {
        $self = clone $this;
        $self['schools'] = $schools;

        return $self;
    }

    /**
     * Professional skills.
     *
     * @param list<string> $skills
     */
    public function withSkills(array $skills): self
    {
        $self = clone $this;
        $self['skills'] = $skills;

        return $self;
    }

    /**
     * Years of professional experience.
     */
    public function withYearsOfExperience(?int $yearsOfExperience): self
    {
        $self = clone $this;
        $self['yearsOfExperience'] = $yearsOfExperience;

        return $self;
    }

    /**
     * How well the person matches the query. Only returned in `ultra` mode.
     *
     * @param Match_|MatchShape $match
     */
    public function withMatch(Match_|array $match): self
    {
        $self = clone $this;
        $self['match'] = $match;

        return $self;
    }
}
