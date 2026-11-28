<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\Logs\LogGetResponse;
use ContextDev\Logs\LogListResponse;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\LogsContract;

/**
 * Inspect your organization's API requests, including retained inputs and responses.
 *
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class LogsService implements LogsContract
{
    /**
     * @api
     */
    public LogsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new LogsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve a request's metadata, retained input, and response. A request that just finished can return 404 `NOT_FOUND` for a few seconds, so retry shortly.
     *
     * @param string $requestID ID of the request, from its response's `request_id` or `X-Request-Id` header
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $requestID,
        RequestOptions|array|null $requestOptions = null
    ): LogGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($requestID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List your organization's API requests, newest first. Filter by time, endpoint, API key, status, error code, tags, or text. Includes batch settlements and monitor runs.
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
    ): LogListResponse {
        $params = Util::removeNulls(
            [
                'errorCode' => $errorCode,
                'errorsOnly' => $errorsOnly,
                'from' => $from,
                'keyID' => $keyID,
                'limit' => $limit,
                'page' => $page,
                'path' => $path,
                'search' => $search,
                'statusCode' => $statusCode,
                'tags' => $tags,
                'to' => $to,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
