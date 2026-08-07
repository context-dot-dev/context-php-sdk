<?php

declare(strict_types=1);

namespace ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\CurrentRole;
use ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\Education;
use ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\Experience;
use ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\Location;
use ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\Name;

/**
 * @phpstan-import-type EducationShape from \ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\Education
 * @phpstan-import-type ExperienceShape from \ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\Experience
 * @phpstan-import-type CurrentRoleShape from \ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\CurrentRole
 * @phpstan-import-type LocationShape from \ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\Location
 * @phpstan-import-type NameShape from \ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\Name
 *
 * @phpstan-type PersonShape = array{
 *   education: list<Education|EducationShape>,
 *   experience: list<Experience|ExperienceShape>,
 *   skills: list<string>,
 *   socialURLs: list<string>,
 *   websiteURLs: list<string>,
 *   avatarURL?: string|null,
 *   bio?: string|null,
 *   currentRole?: null|CurrentRole|CurrentRoleShape,
 *   email?: string|null,
 *   location?: null|Location|LocationShape,
 *   name?: null|Name|NameShape,
 * }
 */
final class Person implements BaseModel
{
    /** @use SdkModel<PersonShape> */
    use SdkModel;

    /** @var list<Education> $education */
    #[Required(list: Education::class)]
    public array $education;

    /** @var list<Experience> $experience */
    #[Required(list: Experience::class)]
    public array $experience;

    /** @var list<string> $skills */
    #[Required(list: 'string')]
    public array $skills;

    /** @var list<string> $socialURLs */
    #[Required('social_urls', list: 'string')]
    public array $socialURLs;

    /** @var list<string> $websiteURLs */
    #[Required('website_urls', list: 'string')]
    public array $websiteURLs;

    #[Optional('avatar_url')]
    public ?string $avatarURL;

    #[Optional]
    public ?string $bio;

    #[Optional('current_role')]
    public ?CurrentRole $currentRole;

    #[Optional]
    public ?string $email;

    #[Optional]
    public ?Location $location;

    #[Optional]
    public ?Name $name;

    /**
     * `new Person()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Person::with(
     *   education: ...,
     *   experience: ...,
     *   skills: ...,
     *   socialURLs: ...,
     *   websiteURLs: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Person)
     *   ->withEducation(...)
     *   ->withExperience(...)
     *   ->withSkills(...)
     *   ->withSocialURLs(...)
     *   ->withWebsiteURLs(...)
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
     * @param list<Education|EducationShape> $education
     * @param list<Experience|ExperienceShape> $experience
     * @param list<string> $skills
     * @param list<string> $socialURLs
     * @param list<string> $websiteURLs
     * @param CurrentRole|CurrentRoleShape|null $currentRole
     * @param Location|LocationShape|null $location
     * @param Name|NameShape|null $name
     */
    public static function with(
        array $education,
        array $experience,
        array $skills,
        array $socialURLs,
        array $websiteURLs,
        ?string $avatarURL = null,
        ?string $bio = null,
        CurrentRole|array|null $currentRole = null,
        ?string $email = null,
        Location|array|null $location = null,
        Name|array|null $name = null,
    ): self {
        $self = new self;

        $self['education'] = $education;
        $self['experience'] = $experience;
        $self['skills'] = $skills;
        $self['socialURLs'] = $socialURLs;
        $self['websiteURLs'] = $websiteURLs;

        null !== $avatarURL && $self['avatarURL'] = $avatarURL;
        null !== $bio && $self['bio'] = $bio;
        null !== $currentRole && $self['currentRole'] = $currentRole;
        null !== $email && $self['email'] = $email;
        null !== $location && $self['location'] = $location;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    /**
     * @param list<Education|EducationShape> $education
     */
    public function withEducation(array $education): self
    {
        $self = clone $this;
        $self['education'] = $education;

        return $self;
    }

    /**
     * @param list<Experience|ExperienceShape> $experience
     */
    public function withExperience(array $experience): self
    {
        $self = clone $this;
        $self['experience'] = $experience;

        return $self;
    }

    /**
     * @param list<string> $skills
     */
    public function withSkills(array $skills): self
    {
        $self = clone $this;
        $self['skills'] = $skills;

        return $self;
    }

    /**
     * @param list<string> $socialURLs
     */
    public function withSocialURLs(array $socialURLs): self
    {
        $self = clone $this;
        $self['socialURLs'] = $socialURLs;

        return $self;
    }

    /**
     * @param list<string> $websiteURLs
     */
    public function withWebsiteURLs(array $websiteURLs): self
    {
        $self = clone $this;
        $self['websiteURLs'] = $websiteURLs;

        return $self;
    }

    public function withAvatarURL(string $avatarURL): self
    {
        $self = clone $this;
        $self['avatarURL'] = $avatarURL;

        return $self;
    }

    public function withBio(string $bio): self
    {
        $self = clone $this;
        $self['bio'] = $bio;

        return $self;
    }

    /**
     * @param CurrentRole|CurrentRoleShape $currentRole
     */
    public function withCurrentRole(CurrentRole|array $currentRole): self
    {
        $self = clone $this;
        $self['currentRole'] = $currentRole;

        return $self;
    }

    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * @param Location|LocationShape $location
     */
    public function withLocation(Location|array $location): self
    {
        $self = clone $this;
        $self['location'] = $location;

        return $self;
    }

    /**
     * @param Name|NameShape $name
     */
    public function withName(Name|array $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
