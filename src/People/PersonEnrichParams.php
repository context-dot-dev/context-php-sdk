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
use ContextDev\People\PersonEnrichParams\TimeoutOpts;
use ContextDev\People\PersonEnrichParams\Zdr;

/**
 * Match a person from a work email, a profile URL, or a name with company, education, or location context, and get their profile with an identity-match score from 0 to 100. The best candidate is returned even when the match is weak, so set a score threshold for your workflow. `not_found` results are free.
 *
 * @see ContextDev\Services\PeopleService::enrich()
 *
 * @phpstan-import-type CompanyShape from \ContextDev\People\PersonEnrichParams\Company
 * @phpstan-import-type EducationShape from \ContextDev\People\PersonEnrichParams\Education
 * @phpstan-import-type LocationShape from \ContextDev\People\PersonEnrichParams\Location
 * @phpstan-import-type NameShape from \ContextDev\People\PersonEnrichParams\Name
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\People\PersonEnrichParams\TimeoutOpts
 *
 * @phpstan-type PersonEnrichParamsShape = array{
 *   company?: null|Company|CompanyShape,
 *   education?: list<Education|EducationShape>|null,
 *   email?: string|null,
 *   location?: null|Location|LocationShape,
 *   name?: null|Name|NameShape,
 *   socialURLs?: list<string>|null,
 *   tags?: list<string>|null,
 *   timeoutOpts?: null|TimeoutOpts|TimeoutOptsShape,
 *   zdr?: null|Zdr|value-of<Zdr>,
 * }
 */
final class PersonEnrichParams implements BaseModel
{
    /** @use SdkModel<PersonEnrichParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Company associated with the person. Send a `name`, a `domain`, or both.
     */
    #[Optional]
    public ?Company $company;

    /**
     * Education history to help distinguish people with similar names.
     *
     * @var list<Education>|null $education
     */
    #[Optional(list: Education::class)]
    public ?array $education;

    /**
     * Work email address of the person. Free and disposable email providers return 422.
     */
    #[Optional]
    public ?string $email;

    /**
     * Location associated with the person. Send at least one of `city`, `region`, or `country`.
     */
    #[Optional]
    public ?Location $location;

    /**
     * Name of the person. Without an email or profile URL, send both `first` and `last` plus `company`, `education`, or `location`.
     */
    #[Optional]
    public ?Name $name;

    /**
     * Public profile URLs for the person. A person-profile URL is enough to identify them without a name.
     *
     * @var list<string>|null $socialURLs
     */
    #[Optional('social_urls', list: 'string')]
    public ?array $socialURLs;

    /**
     * Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Request deadline and what to return when it passes.
     */
    #[Optional]
    public ?TimeoutOpts $timeoutOpts;

    /**
     * `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     *
     * @var value-of<Zdr>|null $zdr
     */
    #[Optional(enum: Zdr::class)]
    public ?string $zdr;

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
     * @param TimeoutOpts|TimeoutOptsShape|null $timeoutOpts
     * @param Zdr|value-of<Zdr>|null $zdr
     */
    public static function with(
        Company|array|null $company = null,
        ?array $education = null,
        ?string $email = null,
        Location|array|null $location = null,
        Name|array|null $name = null,
        ?array $socialURLs = null,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
        Zdr|string|null $zdr = null,
    ): self {
        $self = new self;

        null !== $company && $self['company'] = $company;
        null !== $education && $self['education'] = $education;
        null !== $email && $self['email'] = $email;
        null !== $location && $self['location'] = $location;
        null !== $name && $self['name'] = $name;
        null !== $socialURLs && $self['socialURLs'] = $socialURLs;
        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutOpts && $self['timeoutOpts'] = $timeoutOpts;
        null !== $zdr && $self['zdr'] = $zdr;

        return $self;
    }

    /**
     * Company associated with the person. Send a `name`, a `domain`, or both.
     *
     * @param Company|CompanyShape $company
     */
    public function withCompany(Company|array $company): self
    {
        $self = clone $this;
        $self['company'] = $company;

        return $self;
    }

    /**
     * Education history to help distinguish people with similar names.
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
     * Work email address of the person. Free and disposable email providers return 422.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * Location associated with the person. Send at least one of `city`, `region`, or `country`.
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
     * Name of the person. Without an email or profile URL, send both `first` and `last` plus `company`, `education`, or `location`.
     *
     * @param Name|NameShape $name
     */
    public function withName(Name|array $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Public profile URLs for the person. A person-profile URL is enough to identify them without a name.
     *
     * @param list<string> $socialURLs
     */
    public function withSocialURLs(array $socialURLs): self
    {
        $self = clone $this;
        $self['socialURLs'] = $socialURLs;

        return $self;
    }

    /**
     * Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
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
     * Request deadline and what to return when it passes.
     *
     * @param TimeoutOpts|TimeoutOptsShape $timeoutOpts
     */
    public function withTimeoutOpts(TimeoutOpts|array $timeoutOpts): self
    {
        $self = clone $this;
        $self['timeoutOpts'] = $timeoutOpts;

        return $self;
    }

    /**
     * `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     *
     * @param Zdr|value-of<Zdr> $zdr
     */
    public function withZdr(Zdr|string $zdr): self
    {
        $self = clone $this;
        $self['zdr'] = $zdr;

        return $self;
    }
}
