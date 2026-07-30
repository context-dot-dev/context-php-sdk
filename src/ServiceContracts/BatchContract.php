<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Batch\BatchCancelResponse;
use ContextDev\Batch\BatchGetResponse;
use ContextDev\Batch\BatchGetResultsResponse;
use ContextDev\Batch\BatchListParams\Status;
use ContextDev\Batch\BatchListResponse;
use ContextDev\Batch\BatchSubmitParams\Identifiers;
use ContextDev\Batch\BatchSubmitResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;

/**
 * @phpstan-import-type IdentifiersShape from \ContextDev\Batch\BatchSubmitParams\Identifiers
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface BatchContract
{
    /**
     * @api
     *
     * @param string $batchID ID of the batch to retrieve or cancel
     * @param list<string> $tags Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $batchID,
        ?array $tags = null,
        RequestOptions|array|null $requestOptions = null,
    ): BatchGetResponse;

    /**
     * @api
     *
     * @param string $cursor cursor from the previous page
     * @param int $limit Batches per page. Defaults to 25.
     * @param Status|value-of<Status> $status filter by status
     * @param list<string> $tags Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?int $limit = null,
        Status|string|null $status = null,
        ?array $tags = null,
        RequestOptions|array|null $requestOptions = null,
    ): BatchListResponse;

    /**
     * @api
     *
     * @param string $batchID ID of the batch to retrieve or cancel
     * @param list<string> $tags Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $batchID,
        ?array $tags = null,
        RequestOptions|array|null $requestOptions = null,
    ): BatchCancelResponse;

    /**
     * @api
     *
     * @param string $batchID ID of the batch to retrieve or cancel
     * @param string $cursor next_cursor from the previous page
     * @param int $limit Records per page. Defaults to 25. A page can close early so its payload stays under ~8 MB; rely on next_cursor rather than counting records.
     * @param list<string> $tags Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getResults(
        string $batchID,
        ?string $cursor = null,
        ?int $limit = null,
        ?array $tags = null,
        RequestOptions|array|null $requestOptions = null,
    ): BatchGetResultsResponse;

    /**
     * @api
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
    ): BatchSubmitResponse;
}
