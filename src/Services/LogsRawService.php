<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\Logs\LogGetResponse;
use ContextDev\Logs\LogListParams;
use ContextDev\Logs\LogListResponse;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\LogsRawContract;

/**
 * Read your organization's API request logs to debug failed calls. These endpoints cost no credits and use a separate rate limit.
 *
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class LogsRawService implements LogsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get one logged API call, including its request input and response body.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['logs/%1$s', $requestID],
            options: $requestOptions,
            convert: LogGetResponse::class,
        );
    }

    /**
     * @api
     *
     * List your organization's API requests, newest first. Defaults to the last 24 hours.
     *
     * @param array{
     *   errorCode?: string,
     *   errorsOnly?: bool,
     *   from?: \DateTimeInterface,
     *   keyID?: string,
     *   limit?: int,
     *   page?: int,
     *   path?: string,
     *   search?: string,
     *   statusCode?: int,
     *   tags?: string,
     *   to?: \DateTimeInterface,
     * }|LogListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LogListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|LogListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LogListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'logs',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'errorCode' => 'error_code',
                    'errorsOnly' => 'errors_only',
                    'keyID' => 'key_id',
                    'statusCode' => 'status_code',
                ],
            ),
            options: $options,
            convert: LogListResponse::class,
        );
    }
}
