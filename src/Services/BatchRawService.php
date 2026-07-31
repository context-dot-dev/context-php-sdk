<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Batch\BatchCancelResponse;
use ContextDev\Batch\BatchGetResponse;
use ContextDev\Batch\BatchGetResultsParams;
use ContextDev\Batch\BatchGetResultsResponse;
use ContextDev\Batch\BatchListParams;
use ContextDev\Batch\BatchListParams\SearchType;
use ContextDev\Batch\BatchListParams\Status;
use ContextDev\Batch\BatchListResponse;
use ContextDev\Batch\BatchSubmitParams;
use ContextDev\Batch\BatchSubmitParams\Identifiers;
use ContextDev\Batch\BatchSubmitResponse;
use ContextDev\Client;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\BatchRawContract;

/**
 * @phpstan-import-type IdentifiersShape from \ContextDev\Batch\BatchSubmitParams\Identifiers
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class BatchRawService implements BatchRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Check progress and get download links when the batch finishes. Also returns the rejected-URL list and webhook signing secret from submission, so nothing is lost if the submit response was dropped.
     *
     * @param string $batchID ID of the batch to retrieve or cancel
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BatchGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $batchID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['batch/%1$s', $batchID],
            options: $requestOptions,
            convert: BatchGetResponse::class,
        );
    }

    /**
     * @api
     *
     * List your batches from newest to oldest. Filter by status or continue with a cursor.
     *
     * @param array{
     *   cursor?: string,
     *   limit?: int,
     *   q?: string,
     *   searchType?: SearchType|value-of<SearchType>,
     *   status?: Status|value-of<Status>,
     *   tags?: string,
     * }|BatchListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BatchListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|BatchListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BatchListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'batch/list',
            query: Util::array_transform_keys(
                $parsed,
                ['searchType' => 'search_type']
            ),
            options: $options,
            convert: BatchListResponse::class,
        );
    }

    /**
     * @api
     *
     * Stop a batch from starting new pages. In-progress pages finish, and unused credits are refunded.
     *
     * @param string $batchID ID of the batch to retrieve or cancel
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BatchCancelResponse>
     *
     * @throws APIException
     */
    public function cancel(
        string $batchID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['batch/%1$s/cancel', $batchID],
            options: $requestOptions,
            convert: BatchCancelResponse::class,
        );
    }

    /**
     * @api
     *
     * Page through the result records of a finished batch as JSON, in the same order as the downloadable result files. Use this instead of downloading and parsing the NDJSON files yourself.
     *
     * @param string $batchID ID of the batch to retrieve or cancel
     * @param array{cursor?: string, limit?: int}|BatchGetResultsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BatchGetResultsResponse>
     *
     * @throws APIException
     */
    public function getResults(
        string $batchID,
        array|BatchGetResultsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BatchGetResultsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['batch/%1$s/results', $batchID],
            query: $parsed,
            options: $options,
            convert: BatchGetResultsResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve and normalize a person profile from identifiers.
     *
     * @param array{
     *   identifiers: Identifiers|IdentifiersShape,
     *   tags?: list<string>,
     *   timeoutMs?: int,
     * }|BatchSubmitParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BatchSubmitResponse>
     *
     * @throws APIException
     */
    public function submit(
        array|BatchSubmitParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BatchSubmitParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'people/retrieve',
            body: (object) $parsed,
            options: $options,
            convert: BatchSubmitResponse::class,
        );
    }
}
