<?php

declare(strict_types=1);

namespace ContextDev\Services\Webhooks;

use ContextDev\Client;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\Webhooks\DeliveriesContract;
use ContextDev\Webhooks\Deliveries\DeliveryGetResponse;
use ContextDev\Webhooks\Deliveries\DeliveryListAttemptsResponse;
use ContextDev\Webhooks\Deliveries\DeliveryListParams\Status;
use ContextDev\Webhooks\Deliveries\DeliveryListParams\Type;
use ContextDev\Webhooks\Deliveries\DeliveryListResponse;
use ContextDev\Webhooks\Deliveries\DeliveryRetryResponse;

/**
 * Inspect and retry batch and monitor webhook deliveries.
 *
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class DeliveriesService implements DeliveriesContract
{
    /**
     * @api
     */
    public DeliveriesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new DeliveriesRawService($client);
    }

    /**
     * @api
     *
     * Retrieve a webhook delivery's status, retry settings, and most recent attempt.
     *
     * @param string $deliveryID ID of the delivery
     * @param list<string> $tags Comma-separated labels for this request, such as `production,team-alpha`. Filter usage and request logs by them.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $deliveryID,
        ?array $tags = null,
        RequestOptions|array|null $requestOptions = null,
    ): DeliveryGetResponse {
        $params = Util::removeNulls(['tags' => $tags]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($deliveryID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List webhook deliveries for your batches or monitors from the last 30 days, newest first. Filter by source, status, or creation time.
     *
     * @param Type|value-of<Type> $type list monitor webhook deliveries
     * @param string $batchID filter by batch ID
     * @param \DateTimeInterface $createdAfter only include deliveries created after this time
     * @param string $cursor Cursor from the previous page's `next_cursor`. Omit for the first page.
     * @param int $limit maximum number of deliveries to return per page
     * @param Status|value-of<Status> $status filter by delivery status
     * @param list<string> $tags Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
     * @param string $monitorID filter by monitor ID
     * @param string $runID filter by monitor run ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        Type|string $type,
        ?string $batchID = null,
        ?\DateTimeInterface $createdAfter = null,
        ?string $cursor = null,
        int $limit = 25,
        Status|string|null $status = null,
        ?array $tags = null,
        ?string $monitorID = null,
        ?string $runID = null,
        RequestOptions|array|null $requestOptions = null,
    ): DeliveryListResponse {
        $params = Util::removeNulls(
            [
                'type' => $type,
                'batchID' => $batchID,
                'createdAfter' => $createdAfter,
                'cursor' => $cursor,
                'limit' => $limit,
                'status' => $status,
                'tags' => $tags,
                'monitorID' => $monitorID,
                'runID' => $runID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List a webhook delivery's attempts, newest first.
     *
     * @param string $deliveryID ID of the delivery
     * @param string $cursor Cursor from the previous page's `next_cursor`. Omit for the first page.
     * @param int $limit maximum number of attempts to return per page
     * @param list<string> $tags Comma-separated labels for this request, such as `production,team-alpha`. Filter usage and request logs by them.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listAttempts(
        string $deliveryID,
        ?string $cursor = null,
        int $limit = 25,
        ?array $tags = null,
        RequestOptions|array|null $requestOptions = null,
    ): DeliveryListAttemptsResponse {
        $params = Util::removeNulls(
            ['cursor' => $cursor, 'limit' => $limit, 'tags' => $tags]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listAttempts($deliveryID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Resend a delivery's original payload to the source's current webhook URL, signed with its current secret. Available for 7 days after the event.
     *
     * @param string $deliveryID path param: ID of the delivery
     * @param bool $force body param: Resend even if the delivery already succeeded
     * @param list<string> $tags Body param: Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
     * @param string $idempotencyKey Header param: Unique key for this retry. Repeating the request with the same key does not send the payload again.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retry(
        string $deliveryID,
        bool $force = false,
        ?array $tags = null,
        ?string $idempotencyKey = null,
        RequestOptions|array|null $requestOptions = null,
    ): DeliveryRetryResponse {
        $params = Util::removeNulls(
            ['force' => $force, 'tags' => $tags, 'idempotencyKey' => $idempotencyKey]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retry($deliveryID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
