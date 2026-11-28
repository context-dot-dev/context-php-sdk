<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\People\PersonEnrichParams\Company;
use ContextDev\People\PersonEnrichParams\Education;
use ContextDev\People\PersonEnrichParams\Location;
use ContextDev\People\PersonEnrichParams\Name;
use ContextDev\People\PersonEnrichParams\TimeoutOpts;
use ContextDev\People\PersonEnrichParams\Zdr;
use ContextDev\People\PersonEnrichResponse;
use ContextDev\People\PersonSearchParams\Filters;
use ContextDev\People\PersonSearchParams\Mode;
use ContextDev\People\PersonSearchResponse;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\PeopleContract;

/**
 * Enrich a person from identity clues, or find people with a natural-language query.
 *
 * @phpstan-import-type CompanyShape from \ContextDev\People\PersonEnrichParams\Company
 * @phpstan-import-type EducationShape from \ContextDev\People\PersonEnrichParams\Education
 * @phpstan-import-type LocationShape from \ContextDev\People\PersonEnrichParams\Location
 * @phpstan-import-type NameShape from \ContextDev\People\PersonEnrichParams\Name
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\People\PersonEnrichParams\TimeoutOpts
 * @phpstan-import-type FiltersShape from \ContextDev\People\PersonSearchParams\Filters
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class PeopleService implements PeopleContract
{
    /**
     * @api
     */
    public PeopleRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PeopleRawService($client);
    }

    /**
     * @api
     *
     * Match a person from a work email, a profile URL, or a name with company, education, or location context, and get their profile with an identity-match score from 0 to 100. The best candidate is returned even when the match is weak, so set a score threshold for your workflow. `not_found` results are free.
     *
     * @param Company|CompanyShape $company Company associated with the person. Send a `name`, a `domain`, or both.
     * @param list<Education|EducationShape> $education education history to help distinguish people with similar names
     * @param string $email Work email address of the person. Free and disposable email providers return 422.
     * @param Location|LocationShape $location Location associated with the person. Send at least one of `city`, `region`, or `country`.
     * @param Name|NameShape $name Name of the person. Without an email or profile URL, send both `first` and `last` plus `company`, `education`, or `location`.
     * @param list<string> $socialURLs Public profile URLs for the person. A person-profile URL is enough to identify them without a name.
     * @param list<string> $tags Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
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
    ): PersonEnrichResponse {
        $params = Util::removeNulls(
            [
                'company' => $company,
                'education' => $education,
                'email' => $email,
                'location' => $location,
                'name' => $name,
                'socialURLs' => $socialURLs,
                'tags' => $tags,
                'timeoutOpts' => $timeoutOpts,
                'zdr' => $zdr,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->enrich(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Find people from a plain-language description, such as `VPs of sales at solar companies in California`. Each result includes the current role and employer, location, years of experience, skills, schools, and public profile URLs. Pages with no matches are free.
     *
     * @param string $query Plain-language description of the people to find. Up to 500 characters in `fast` mode and 5000 in `ultra` mode.
     * @param string $cursor Cursor from the previous page's `next_cursor`. Omit for the first page. Send the same `query`, `mode`, and `filters` with it.
     * @param Filters|FiltersShape $filters constraints every result must match, in addition to `query`
     * @param Mode|value-of<Mode> $mode `fast` matches people on basic criteria such as role, location, or background; `ultra` runs a deeper search, checks every candidate against each criterion in your query, and adds a `match` score. Complex `ultra` searches can take up to 30 seconds, so set your client timeout to match.
     * @param list<string> $tags Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
     * @param \ContextDev\People\PersonSearchParams\Zdr|value-of<\ContextDev\People\PersonSearchParams\Zdr> $zdr `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function search(
        string $query,
        ?string $cursor = null,
        Filters|array|null $filters = null,
        Mode|string $mode = 'fast',
        ?array $tags = null,
        \ContextDev\People\PersonSearchParams\Zdr|string|null $zdr = null,
        RequestOptions|array|null $requestOptions = null,
    ): PersonSearchResponse {
        $params = Util::removeNulls(
            [
                'query' => $query,
                'cursor' => $cursor,
                'filters' => $filters,
                'mode' => $mode,
                'tags' => $tags,
                'zdr' => $zdr,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->search(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
