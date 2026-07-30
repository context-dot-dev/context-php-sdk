<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitResponse;

use ContextDev\Batch\BatchSubmitResponse\Person\Education;
use ContextDev\Batch\BatchSubmitResponse\Person\Experience;
use ContextDev\Batch\BatchSubmitResponse\Person\Profile;
use ContextDev\Batch\BatchSubmitResponse\Person\Skill;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Retrieved person profile.
 *
 * @phpstan-import-type EducationShape from \ContextDev\Batch\BatchSubmitResponse\Person\Education
 * @phpstan-import-type ExperienceShape from \ContextDev\Batch\BatchSubmitResponse\Person\Experience
 * @phpstan-import-type ProfileShape from \ContextDev\Batch\BatchSubmitResponse\Person\Profile
 * @phpstan-import-type SkillShape from \ContextDev\Batch\BatchSubmitResponse\Person\Skill
 *
 * @phpstan-type PersonShape = array{
 *   education: list<Education|EducationShape>,
 *   experience: list<Experience|ExperienceShape>,
 *   profile: Profile|ProfileShape,
 *   skills: list<Skill|SkillShape>,
 * }
 */
final class Person implements BaseModel
{
    /** @use SdkModel<PersonShape> */
    use SdkModel;

    /**
     * Education history.
     *
     * @var list<Education> $education
     */
    #[Required(list: Education::class)]
    public array $education;

    /**
     * Work history.
     *
     * @var list<Experience> $experience
     */
    #[Required(list: Experience::class)]
    public array $experience;

    /**
     * Core profile details.
     */
    #[Required]
    public Profile $profile;

    /**
     * Listed skills.
     *
     * @var list<Skill> $skills
     */
    #[Required(list: Skill::class)]
    public array $skills;

    /**
     * `new Person()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Person::with(education: ..., experience: ..., profile: ..., skills: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Person)
     *   ->withEducation(...)
     *   ->withExperience(...)
     *   ->withProfile(...)
     *   ->withSkills(...)
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
     * @param Profile|ProfileShape $profile
     * @param list<Skill|SkillShape> $skills
     */
    public static function with(
        array $education,
        array $experience,
        Profile|array $profile,
        array $skills
    ): self {
        $self = new self;

        $self['education'] = $education;
        $self['experience'] = $experience;
        $self['profile'] = $profile;
        $self['skills'] = $skills;

        return $self;
    }

    /**
     * Education history.
     *
     * @param list<Education|EducationShape> $education
     */
    public function withEducation(array $education): self
    {
        $self = clone $this;
        $self['education'] = $education;

        return $self;
    }

    /**
     * Work history.
     *
     * @param list<Experience|ExperienceShape> $experience
     */
    public function withExperience(array $experience): self
    {
        $self = clone $this;
        $self['experience'] = $experience;

        return $self;
    }

    /**
     * Core profile details.
     *
     * @param Profile|ProfileShape $profile
     */
    public function withProfile(Profile|array $profile): self
    {
        $self = clone $this;
        $self['profile'] = $profile;

        return $self;
    }

    /**
     * Listed skills.
     *
     * @param list<Skill|SkillShape> $skills
     */
    public function withSkills(array $skills): self
    {
        $self = clone $this;
        $self['skills'] = $skills;

        return $self;
    }
}
