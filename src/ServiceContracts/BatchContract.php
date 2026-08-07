<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Batch\BatchCancelResponse;
use ContextDev\Batch\BatchDeleteResponse;
use ContextDev\Batch\BatchGetResponse;
use ContextDev\Batch\BatchGetResultsResponse;
use ContextDev\Batch\BatchListParams\SearchType;
use ContextDev\Batch\BatchListParams\Status;
use ContextDev\Batch\BatchListResponse;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape;
use ContextDev\Batch\BatchSubmitResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;

/**
 * @phpstan-import-type InputShape from \ContextDev\Batch\BatchSubmitParams\Input
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface BatchContract
{
    /**
     * @api
     *
     * @param string $batchID ID of the batch to retrieve or cancel
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $batchID,
        RequestOptions|array|null $requestOptions = null
    ): BatchGetResponse;

    /**
     * @api
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
    ): BatchListResponse;

    /**
     * @api
     *
     * @param string $batchID ID of the batch to retrieve or cancel
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $batchID,
        RequestOptions|array|null $requestOptions = null
    ): BatchDeleteResponse;

    /**
     * @api
     *
     * @param string $batchID ID of the batch to retrieve or cancel
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $batchID,
        RequestOptions|array|null $requestOptions = null
    ): BatchCancelResponse;

    /**
     * @api
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
    ): BatchGetResultsResponse;

    /**
     * @api
     *
     * @param InputShape $input body param: Choose a URL list or a site crawl
     * @param list<string> $tags Body param: Tags stored on the batch. Filter the batch list by them later.
     * @param string $webhookURL body param: URL notified when the batch finishes
     * @param string $idempotencyKey Header param: Any string unique to this submission. Retries with the same key return the original batch.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function submit(
        Scrape|array|Crawl $input,
        ?array $tags = null,
        ?string $webhookURL = null,
        ?string $idempotencyKey = null,
        RequestOptions|array|null $requestOptions = null,
    ): BatchSubmitResponse;
}
