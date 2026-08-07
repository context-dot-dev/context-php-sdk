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
use ContextDev\People\PersonEnrichResponse;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\PeopleContract;

/**
 * @phpstan-import-type CompanyShape from \ContextDev\People\PersonEnrichParams\Company
 * @phpstan-import-type EducationShape from \ContextDev\People\PersonEnrichParams\Education
 * @phpstan-import-type LocationShape from \ContextDev\People\PersonEnrichParams\Location
 * @phpstan-import-type NameShape from \ContextDev\People\PersonEnrichParams\Name
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
     * Finds and normalizes the best available person candidate from additive identity clues, then assigns an identity match score from 0 to 100. Available on all paid plans. Successful requests cost 20 credits. Disposable and free email addresses (like gmail.com, yahoo.com) will throw a 422 error.
     *
     * @param Company|CompanyShape $company
     * @param list<Education|EducationShape> $education
     * @param Location|LocationShape $location
     * @param Name|NameShape $name
     * @param list<string> $socialURLs
     * @param list<string> $tags Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
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
        ?int $timeoutMs = null,
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
                'timeoutMs' => $timeoutMs,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->enrich(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
