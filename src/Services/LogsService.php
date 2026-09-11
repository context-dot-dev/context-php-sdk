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
 * Read your organization's API request logs to debug failed calls. These endpoints cost no credits and use a separate rate limit.
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
     * Get one logged API call, including its request input and response body.
     *
     * @param string $requestID the request ID of the logged API call
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
     * List your organization's API requests, newest first. Defaults to the last 24 hours.
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
