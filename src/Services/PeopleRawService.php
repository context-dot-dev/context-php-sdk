<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\People\PersonEnrichParams;
use ContextDev\People\PersonEnrichParams\Company;
use ContextDev\People\PersonEnrichParams\Education;
use ContextDev\People\PersonEnrichParams\Location;
use ContextDev\People\PersonEnrichParams\Name;
use ContextDev\People\PersonEnrichParams\TimeoutOpts;
use ContextDev\People\PersonEnrichParams\Zdr;
use ContextDev\People\PersonEnrichResponse;
use ContextDev\People\PersonSearchParams;
use ContextDev\People\PersonSearchParams\Filters;
use ContextDev\People\PersonSearchParams\Mode;
use ContextDev\People\PersonSearchResponse;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\PeopleRawContract;

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
final class PeopleRawService implements PeopleRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Match a person from a work email, a profile URL, or a name with company, education, or location context, and get their profile with an identity-match score from 0 to 100. The best candidate is returned even when the match is weak, so set a score threshold for your workflow. `not_found` results are free.
     *
     * @param array{
     *   company?: Company|CompanyShape,
     *   education?: list<Education|EducationShape>,
     *   email?: string,
     *   location?: Location|LocationShape,
     *   name?: Name|NameShape,
     *   socialURLs?: list<string>,
     *   tags?: list<string>,
     *   timeoutOpts?: TimeoutOpts|TimeoutOptsShape,
     *   zdr?: Zdr|value-of<Zdr>,
     * }|PersonEnrichParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PersonEnrichResponse>
     *
     * @throws APIException
     */
    public function enrich(
        array|PersonEnrichParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PersonEnrichParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'people/enrich',
            body: (object) $parsed,
            options: $options,
            convert: PersonEnrichResponse::class,
        );
    }

    /**
     * @api
     *
     * Find people from a plain-language description, such as `VPs of sales at solar companies in California`. Each result includes the current role and employer, location, years of experience, skills, schools, and public profile URLs. Pages with no matches are free.
     *
     * @param array{
     *   query: string,
     *   cursor?: string,
     *   filters?: Filters|FiltersShape,
     *   mode?: Mode|value-of<Mode>,
     *   tags?: list<string>,
     *   zdr?: PersonSearchParams\Zdr|value-of<PersonSearchParams\Zdr>,
     * }|PersonSearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PersonSearchResponse>
     *
     * @throws APIException
     */
    public function search(
        array|PersonSearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PersonSearchParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'people/search',
            body: (object) $parsed,
            options: $options,
            convert: PersonSearchResponse::class,
        );
    }
}
