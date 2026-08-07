<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Batch\BatchCancelResponse;
use ContextDev\Batch\BatchDeleteResponse;
use ContextDev\Batch\BatchGetResponse;
use ContextDev\Batch\BatchGetResultsParams;
use ContextDev\Batch\BatchGetResultsResponse;
use ContextDev\Batch\BatchListParams;
use ContextDev\Batch\BatchListParams\SearchType;
use ContextDev\Batch\BatchListParams\Status;
use ContextDev\Batch\BatchListResponse;
use ContextDev\Batch\BatchSubmitParams;
use ContextDev\Batch\BatchSubmitResponse;
use ContextDev\Client;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\BatchRawContract;

/**
 * Scrape many pages or crawl a site asynchronously.
 *
 * @phpstan-import-type InputShape from \ContextDev\Batch\BatchSubmitParams\Input
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
     * Check progress, and get download links once the batch finishes.
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
     * Permanently delete a finished batch and its stored results. Active batches must settle first.
     *
     * @param string $batchID ID of the batch to retrieve or cancel
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BatchDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $batchID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['batch/%1$s', $batchID],
            options: $requestOptions,
            convert: BatchDeleteResponse::class,
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
     * Page through a finished batch's results as JSON instead of downloading the NDJSON files.
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
     * Scrape 25K URLs or crawl large websites asynchronously.
     *
     * @param array{
     *   input: InputShape,
     *   tags?: list<string>,
     *   webhookURL?: string,
     *   idempotencyKey?: string,
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
        $header_params = ['idempotencyKey' => 'Idempotency-Key'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'batch/submit',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: BatchSubmitResponse::class,
        );
    }
}
