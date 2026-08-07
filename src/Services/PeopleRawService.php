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
use ContextDev\People\PersonEnrichResponse;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\PeopleRawContract;

/**
 * @phpstan-import-type CompanyShape from \ContextDev\People\PersonEnrichParams\Company
 * @phpstan-import-type EducationShape from \ContextDev\People\PersonEnrichParams\Education
 * @phpstan-import-type LocationShape from \ContextDev\People\PersonEnrichParams\Location
 * @phpstan-import-type NameShape from \ContextDev\People\PersonEnrichParams\Name
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
     * Finds and normalizes the best available person candidate from additive identity clues, then assigns an identity match score from 0 to 100. Available on all paid plans. Successful requests cost 20 credits. Disposable and free email addresses (like gmail.com, yahoo.com) will throw a 422 error.
     *
     * @param array{
     *   company?: Company|CompanyShape,
     *   education?: list<Education|EducationShape>,
     *   email?: string,
     *   location?: Location|LocationShape,
     *   name?: Name|NameShape,
     *   socialURLs?: list<string>,
     *   tags?: list<string>,
     *   timeoutMs?: int,
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
}
