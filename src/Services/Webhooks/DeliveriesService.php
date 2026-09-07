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
use ContextDev\Webhooks\Deliveries\DeliveryListResponse;
use ContextDev\Webhooks\Deliveries\DeliveryRetryResponse;

/**
 * Inspect and retry batch and monitor webhook deliveries without rerunning the underlying work.
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
     * Get the live status, retry policy, latest attempt, and replay expiration for a retained delivery. Use the attempts endpoint for its complete paginated history. This endpoint costs no credits.
     *
     * @param list<string> $tags Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
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
     * List retained batch and monitor webhook deliveries for your organization, newest first. Filter by at most one of batch_id, monitor_id, or run_id, optionally combined with status. Historical events without retained payloads are not listed. This endpoint costs no credits.
     *
     * @param Status|value-of<Status> $status
     * @param list<string> $tags Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $batchID = null,
        ?string $cursor = null,
        int $limit = 25,
        ?string $monitorID = null,
        ?string $runID = null,
        Status|string|null $status = null,
        ?array $tags = null,
        RequestOptions|array|null $requestOptions = null,
    ): DeliveryListResponse {
        $params = Util::removeNulls(
            [
                'batchID' => $batchID,
                'cursor' => $cursor,
                'limit' => $limit,
                'monitorID' => $monitorID,
                'runID' => $runID,
                'status' => $status,
                'tags' => $tags,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List individual HTTP attempts for a delivery, newest first, including their destination, timestamps, HTTP status, and error. An interrupted attempt may have reached the endpoint even when its outcome is unknown. This endpoint costs no credits.
     *
     * @param list<string> $tags Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
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
     * Queue an immediate attempt without rerunning or billing the underlying batch or monitor. A waiting retry is brought forward. A failed delivery gets one additional attempt without restarting its automatic retry budget. Set force: true to resend an acknowledged delivery. An in-progress attempt cannot be duplicated. The stored event body, event ID, and creation time remain unchanged; each attempt receives a fresh signature. Monitor retries use the current URL and secret; removing the webhook cancels pending deliveries. Batch result URLs in old payloads may have expired: retrieve the batch to get fresh URLs. Replay is available for seven days. A successful attempt cancels remaining automatic retries. Idempotency-Key is scoped to your organization and retained with the delivery metadata; repeating the same key and input returns the original accepted response.
     *
     * @param string $deliveryID Path param
     * @param bool $force Body param
     * @param list<string> $tags Body param: Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
     * @param string $idempotencyKey Header param
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
