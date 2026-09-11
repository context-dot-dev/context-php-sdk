<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Logs\LogGetResponse;
use ContextDev\Logs\LogListParams;
use ContextDev\Logs\LogListResponse;
use ContextDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface LogsRawContract
{
    /**
     * @api
     *
     * @param string $requestID the request ID of the logged API call
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LogGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $requestID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|LogListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LogListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|LogListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
