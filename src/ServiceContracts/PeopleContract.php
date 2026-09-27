<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Exceptions\APIException;
use ContextDev\People\PersonEnrichParams\Company;
use ContextDev\People\PersonEnrichParams\Education;
use ContextDev\People\PersonEnrichParams\Location;
use ContextDev\People\PersonEnrichParams\Name;
use ContextDev\People\PersonEnrichParams\TimeoutOpts;
use ContextDev\People\PersonEnrichParams\Zdr;
use ContextDev\People\PersonEnrichResponse;
use ContextDev\RequestOptions;

/**
 * @phpstan-import-type CompanyShape from \ContextDev\People\PersonEnrichParams\Company
 * @phpstan-import-type EducationShape from \ContextDev\People\PersonEnrichParams\Education
 * @phpstan-import-type LocationShape from \ContextDev\People\PersonEnrichParams\Location
 * @phpstan-import-type NameShape from \ContextDev\People\PersonEnrichParams\Name
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\People\PersonEnrichParams\TimeoutOpts
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface PeopleContract
{
    /**
     * @api
     *
     * @param Company|CompanyShape $company Company context to help identify the person. Provide a name or domain.
     * @param list<Education|EducationShape> $education education history to help distinguish people with similar names
     * @param string $email email address of the person to find
     * @param Location|LocationShape $location Location context to help identify the person. Provide a city, region, or country.
     * @param Name|NameShape $name Person name. Without an email or person-profile URL, provide both first and last name plus company, education, or location.
     * @param list<string> $socialURLs Public profile URLs for the person. A person-profile URL can identify the person without a name.
     * @param list<string> $tags labels for filtering usage in the dashboard
     * @param TimeoutOpts|TimeoutOptsShape $timeoutOpts request deadline and what to return when it passes
     * @param Zdr|value-of<Zdr> $zdr `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function enrich(
        Company|array|null $company = null,
        ?array $education = null,
        ?string $email = null,
        Location|array|null $location = null,
        Name|array|null $name = null,
        ?array $socialURLs = null,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
        Zdr|string|null $zdr = null,
        RequestOptions|array|null $requestOptions = null,
    ): PersonEnrichResponse;
}
