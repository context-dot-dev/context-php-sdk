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
 * Find a person from identity clues and return their profile with a match score. Requires a paid plan; free or disposable email addresses return 422.
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
     * Company context to help identify the person. Provide a name or domain.
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
     * Email address of the person to find.
     */
    #[Optional]
    public ?string $email;

    /**
     * Location context to help identify the person. Provide a city, region, or country.
     */
    #[Optional]
    public ?Location $location;

    /**
     * Person name. Without an email or person-profile URL, provide both first and last name plus company, education, or location.
     */
    #[Optional]
    public ?Name $name;

    /**
     * Public profile URLs for the person. A person-profile URL can identify the person without a name.
     *
     * @var list<string>|null $socialURLs
     */
    #[Optional('social_urls', list: 'string')]
    public ?array $socialURLs;

    /**
     * Labels for filtering usage in the dashboard.
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
     * Company context to help identify the person. Provide a name or domain.
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
     * Email address of the person to find.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * Location context to help identify the person. Provide a city, region, or country.
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
     * Person name. Without an email or person-profile URL, provide both first and last name plus company, education, or location.
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
     * Public profile URLs for the person. A person-profile URL can identify the person without a name.
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
     * Labels for filtering usage in the dashboard.
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
