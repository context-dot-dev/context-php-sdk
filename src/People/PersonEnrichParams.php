<?php

declare(strict_types=1);

namespace ContextDev\People;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\People\PersonEnrichParams\Company;
use ContextDev\People\PersonEnrichParams\Education;
use ContextDev\People\PersonEnrichParams\Location;
use ContextDev\People\PersonEnrichParams\Name;

/**
 * Finds and normalizes the best available person candidate from additive identity clues, then assigns an identity match score from 0 to 100. Available on Pro and Scale plans. Successful requests cost 20 credits. Disposable and free email addresses (like gmail.com, yahoo.com) will throw a 422 error.
 *
 * @see ContextDev\Services\PeopleService::enrich()
 *
 * @phpstan-import-type CompanyShape from \ContextDev\People\PersonEnrichParams\Company
 * @phpstan-import-type EducationShape from \ContextDev\People\PersonEnrichParams\Education
 * @phpstan-import-type LocationShape from \ContextDev\People\PersonEnrichParams\Location
 * @phpstan-import-type NameShape from \ContextDev\People\PersonEnrichParams\Name
 *
 * @phpstan-type PersonEnrichParamsShape = array{
 *   company?: null|Company|CompanyShape,
 *   education?: list<Education|EducationShape>|null,
 *   email?: string|null,
 *   location?: null|Location|LocationShape,
 *   name?: null|Name|NameShape,
 *   socialURLs?: list<string>|null,
 *   tags?: list<string>|null,
 *   timeoutMs?: int|null,
 * }
 */
final class PersonEnrichParams implements BaseModel
{
    /** @use SdkModel<PersonEnrichParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?Company $company;

    /** @var list<Education>|null $education */
    #[Optional(list: Education::class)]
    public ?array $education;

    #[Optional]
    public ?string $email;

    #[Optional]
    public ?Location $location;

    #[Optional]
    public ?Name $name;

    /** @var list<string>|null $socialURLs */
    #[Optional('social_urls', list: 'string')]
    public ?array $socialURLs;

    /**
     * Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    #[Optional('timeoutMS')]
    public ?int $timeoutMs;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Company|CompanyShape|null $company
     * @param list<Education|EducationShape>|null $education
     * @param Location|LocationShape|null $location
     * @param Name|NameShape|null $name
     * @param list<string>|null $socialURLs
     * @param list<string>|null $tags
     */
    public static function with(
        Company|array|null $company = null,
        ?array $education = null,
        ?string $email = null,
        Location|array|null $location = null,
        Name|array|null $name = null,
        ?array $socialURLs = null,
        ?array $tags = null,
        ?int $timeoutMs = null,
    ): self {
        $self = new self;

        null !== $company && $self['company'] = $company;
        null !== $education && $self['education'] = $education;
        null !== $email && $self['email'] = $email;
        null !== $location && $self['location'] = $location;
        null !== $name && $self['name'] = $name;
        null !== $socialURLs && $self['socialURLs'] = $socialURLs;
        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutMs && $self['timeoutMs'] = $timeoutMs;

        return $self;
    }

    /**
     * @param Company|CompanyShape $company
     */
    public function withCompany(Company|array $company): self
    {
        $self = clone $this;
        $self['company'] = $company;

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
     * Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
     *
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    public function withTimeoutMs(int $timeoutMs): self
    {
        $self = clone $this;
        $self['timeoutMs'] = $timeoutMs;

        return $self;
    }
}
