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
 * Inspect and retry webhook deliveries. These endpoints cost no credits.
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
     * Get a webhook delivery, including its status and latest attempt.
     *
     * @param string $deliveryID delivery ID
     * @param list<string> $tags Comma-separated tags for tracking request usage. Up to 20 tags, each 1-50 characters.
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
     * List your batch or monitor webhook deliveries, newest first.
     *
     * @param Type|value-of<Type> $type delivery source
     * @param string $batchID filter by batch ID
     * @param \DateTimeInterface $createdAfter only include events created after this ISO 8601 timestamp
     * @param string $cursor the next_cursor from the previous response
     * @param int $limit number of deliveries to return
     * @param Status|value-of<Status> $status filter by delivery status
     * @param list<string> $tags Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
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
     * List delivery attempts, newest first.
     *
     * @param string $deliveryID delivery ID
     * @param string $cursor the next_cursor from the previous response
     * @param int $limit number of attempts to return
     * @param list<string> $tags Comma-separated tags for tracking request usage. Up to 20 tags, each 1-50 characters.
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
     * Retry a webhook delivery within seven days of creation.
     *
     * @param string $deliveryID path param: Delivery ID
     * @param bool $force body param: Resend a delivery that already succeeded
     * @param list<string> $tags Body param: Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
     * @param string $idempotencyKey header param: Unique key to prevent duplicate retry requests
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retry(
        string $deliveryID,
        ?bool $force = null,
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
