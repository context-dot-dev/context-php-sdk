<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Exceptions\APIException;
use ContextDev\Logs\LogGetResponse;
use ContextDev\Logs\LogListResponse;
use ContextDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface LogsContract
{
    /**
     * @api
     *
     * @param string $requestID ID of the request, from its response's `request_id` or `X-Request-Id` header
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $requestID,
        RequestOptions|array|null $requestOptions = null
    ): LogGetResponse;

    /**
     * @api
     *
     * @param string $errorCode filter by the `error_code` returned in the response
     * @param bool $errorsOnly return only requests that failed with a 4xx or 5xx status
     * @param \DateTimeInterface $from Return requests at or after this time. Defaults to 24 hours before `to`.
     * @param string $keyID filter by the ID of the API key that made the request
     * @param int $limit maximum number of log entries to return per page
     * @param int $page page number, starting at 1
     * @param string $path filter by endpoint path, with or without the `/v1` prefix
     * @param string $search case-insensitive text to find in the request query or body, such as a domain
     * @param int $statusCode filter by exact HTTP status code
     * @param string $tags Comma-separated tags. Returns log entries that have any of them. Up to 20 tags of 1 to 50 characters each.
     * @param \DateTimeInterface $to Return requests at or before this time. Defaults to now.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $errorCode = null,
        bool $errorsOnly = false,
        ?\DateTimeInterface $from = null,
        ?string $keyID = null,
        int $limit = 50,
        int $page = 1,
        ?string $path = null,
        ?string $search = null,
        ?int $statusCode = null,
        ?string $tags = null,
        ?\DateTimeInterface $to = null,
        RequestOptions|array|null $requestOptions = null,
    ): LogListResponse;
}
