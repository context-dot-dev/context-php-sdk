<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;
use ContextDev\Scholar\ScholarSearchParams;
use ContextDev\Scholar\ScholarSearchParams\FilterBy;
use ContextDev\Scholar\ScholarSearchParams\Sort;
use ContextDev\Scholar\ScholarSearchResponse;
use ContextDev\ServiceContracts\ScholarRawContract;

/**
 * Search full-text academic papers from arXiv and Europe PMC.
 *
 * @phpstan-import-type FilterByShape from \ContextDev\Scholar\ScholarSearchParams\FilterBy
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class ScholarRawService implements ScholarRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Search the full text of papers from arXiv and Europe PMC by topic or question. Each result includes the matching passage and a direct link to the full text. Page through up to 250 matches, ranked by relevance or newest first.
     *
     * @param array{
     *   query: string,
     *   cursor?: string|null,
     *   filterBy?: FilterBy|FilterByShape,
     *   limit?: int,
     *   sort?: Sort|value-of<Sort>,
     *   tags?: list<string>,
     * }|ScholarSearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ScholarSearchResponse>
     *
     * @throws APIException
     */
    public function search(
        array|ScholarSearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ScholarSearchParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'scholar/search',
            body: (object) $parsed,
            options: $options,
            convert: ScholarSearchResponse::class,
        );
    }
}
