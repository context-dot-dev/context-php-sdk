<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Batch\BatchCancelResponse;
use ContextDev\Batch\BatchDeleteResponse;
use ContextDev\Batch\BatchGetResponse;
use ContextDev\Batch\BatchGetResultsParams;
use ContextDev\Batch\BatchGetResultsResponse;
use ContextDev\Batch\BatchListParams;
use ContextDev\Batch\BatchListResponse;
use ContextDev\Batch\BatchSubmitParams;
use ContextDev\Batch\BatchSubmitResponse;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface BatchRawContract
{
    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|BatchListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BatchListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|BatchListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $batchID ID of the batch to retrieve or cancel
     * @param array<string,mixed>|BatchGetResultsParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|BatchSubmitParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BatchSubmitResponse>
     *
     * @throws APIException
     */
    public function submit(
        array|BatchSubmitParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
