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
 * Inspect your organization's API requests, including retained inputs and responses.
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
     * Retrieve a request's metadata, retained input, and response. A request that just finished can return 404 `NOT_FOUND` for a few seconds, so retry shortly.
     *
     * @param string $requestID ID of the request, from its response's `request_id` or `X-Request-Id` header
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
            path: ['org/logs/%1$s', $requestID],
            options: $requestOptions,
            convert: LogGetResponse::class,
        );
    }

    /**
     * @api
     *
     * List your organization's API requests, newest first. Filter by time, endpoint, API key, status, error code, tags, or text. Includes batch settlements and monitor runs.
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
            path: 'org/logs',
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
