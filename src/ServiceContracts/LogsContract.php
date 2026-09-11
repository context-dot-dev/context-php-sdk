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
     * @param string $requestID the request ID of the logged API call
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
     * @param bool $errorsOnly only include requests that returned a 4xx or 5xx status
     * @param \DateTimeInterface $from Only include requests at or after this ISO 8601 timestamp. Defaults to 24 hours before `to`.
     * @param string $keyID filter by the API key that made the request
     * @param int $limit number of log entries per page
     * @param int $page page number, starting at 1
     * @param string $path filter by endpoint path, with or without the /v1 prefix
     * @param string $search Case-insensitive substring match against the request query and body, e.g. a domain.
     * @param int $statusCode filter by exact HTTP status code
     * @param string $tags Comma-separated request tags. Matches requests carrying any of them. Up to 20 tags, each 1-50 characters.
     * @param \DateTimeInterface $to Only include requests at or before this ISO 8601 timestamp. Defaults to now.
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
