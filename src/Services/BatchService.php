<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Batch\BatchCancelResponse;
use ContextDev\Batch\BatchGetResponse;
use ContextDev\Batch\BatchGetResultsResponse;
use ContextDev\Batch\BatchListParams\SearchType;
use ContextDev\Batch\BatchListParams\Status;
use ContextDev\Batch\BatchListResponse;
use ContextDev\Batch\BatchSubmitParams\Identifiers;
use ContextDev\Batch\BatchSubmitResponse;
use ContextDev\Client;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\BatchContract;

/**
 * @phpstan-import-type IdentifiersShape from \ContextDev\Batch\BatchSubmitParams\Identifiers
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class BatchService implements BatchContract
{
    /**
     * @api
     */
    public BatchRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BatchRawService($client);
    }

    /**
     * @api
     *
     * Check progress, and get download links once the batch finishes.
     *
     * @param string $batchID ID of the batch to retrieve or cancel
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $batchID,
        RequestOptions|array|null $requestOptions = null
    ): BatchGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($batchID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List your batches from newest to oldest. Filter by status or continue with a cursor.
     *
     * @param string $cursor cursor from the previous page
     * @param int $limit Batches per page. Defaults to 25.
     * @param string $q free-text search term, matched against the batch id, crawl source (start URL or sitemap domain), and tags
     * @param SearchType|value-of<SearchType> $searchType `prefix` for as-you-type prefix matching (default), `exact` for full-token matching
     * @param Status|value-of<Status> $status filter by status
     * @param string $tags comma-separated list of tags to filter by (matches batches having any of them)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?int $limit = null,
        ?string $q = null,
        SearchType|string|null $searchType = null,
        Status|string|null $status = null,
        ?string $tags = null,
        RequestOptions|array|null $requestOptions = null,
    ): BatchListResponse {
        $params = Util::removeNulls(
            [
                'cursor' => $cursor,
                'limit' => $limit,
                'q' => $q,
                'searchType' => $searchType,
                'status' => $status,
                'tags' => $tags,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Stop a batch from starting new pages. In-progress pages finish, and unused credits are refunded.
     *
     * @param string $batchID ID of the batch to retrieve or cancel
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $batchID,
        RequestOptions|array|null $requestOptions = null
    ): BatchCancelResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->cancel($batchID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Page through a finished batch's results as JSON instead of downloading the NDJSON files.
     *
     * @param string $batchID ID of the batch to retrieve or cancel
     * @param string $cursor next_cursor from the previous page
     * @param int $limit Records per page. Defaults to 25. A page can close early so its payload stays under ~8 MB; rely on next_cursor rather than counting records.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getResults(
        string $batchID,
        ?string $cursor = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): BatchGetResultsResponse {
        $params = Util::removeNulls(['cursor' => $cursor, 'limit' => $limit]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getResults($batchID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve and normalize a person profile from identifiers.
     *
     * @param Identifiers|IdentifiersShape $identifiers Known identifiers for the person. At least one identifier is required.
     * @param list<string> $tags Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function submit(
        Identifiers|array $identifiers,
        ?array $tags = null,
        ?int $timeoutMs = null,
        RequestOptions|array|null $requestOptions = null,
    ): BatchSubmitResponse {
        $params = Util::removeNulls(
            [
                'identifiers' => $identifiers,
                'tags' => $tags,
                'timeoutMs' => $timeoutMs,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->submit(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
