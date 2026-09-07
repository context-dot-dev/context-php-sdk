<?php

declare(strict_types=1);

namespace ContextDev\Services\Webhooks;

use ContextDev\Client;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\Webhooks\DeliveriesRawContract;
use ContextDev\Webhooks\Deliveries\DeliveryGetResponse;
use ContextDev\Webhooks\Deliveries\DeliveryListAttemptsParams;
use ContextDev\Webhooks\Deliveries\DeliveryListAttemptsResponse;
use ContextDev\Webhooks\Deliveries\DeliveryListParams;
use ContextDev\Webhooks\Deliveries\DeliveryListParams\Status;
use ContextDev\Webhooks\Deliveries\DeliveryListResponse;
use ContextDev\Webhooks\Deliveries\DeliveryRetrieveParams;
use ContextDev\Webhooks\Deliveries\DeliveryRetryParams;
use ContextDev\Webhooks\Deliveries\DeliveryRetryResponse;

/**
 * Inspect and retry batch and monitor webhook deliveries without rerunning the underlying work.
 *
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class DeliveriesRawService implements DeliveriesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get the live status, retry policy, latest attempt, and replay expiration for a retained delivery. Use the attempts endpoint for its complete paginated history. This endpoint costs no credits.
     *
     * @param array{tags?: list<string>}|DeliveryRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeliveryGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $deliveryID,
        array|DeliveryRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DeliveryRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['webhooks/deliveries/%1$s', $deliveryID],
            query: $parsed,
            options: $options,
            convert: DeliveryGetResponse::class,
        );
    }

    /**
     * @api
     *
     * List retained batch and monitor webhook deliveries for your organization, newest first. Filter by at most one of batch_id, monitor_id, or run_id, optionally combined with status. Historical events without retained payloads are not listed. This endpoint costs no credits.
     *
     * @param array{
     *   batchID?: string,
     *   cursor?: string,
     *   limit?: int,
     *   monitorID?: string,
     *   runID?: string,
     *   status?: Status|value-of<Status>,
     *   tags?: list<string>,
     * }|DeliveryListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeliveryListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|DeliveryListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DeliveryListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'webhooks/deliveries',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'batchID' => 'batch_id',
                    'monitorID' => 'monitor_id',
                    'runID' => 'run_id',
                ],
            ),
            options: $options,
            convert: DeliveryListResponse::class,
        );
    }

    /**
     * @api
     *
     * List individual HTTP attempts for a delivery, newest first, including their destination, timestamps, HTTP status, and error. An interrupted attempt may have reached the endpoint even when its outcome is unknown. This endpoint costs no credits.
     *
     * @param array{
     *   cursor?: string, limit?: int, tags?: list<string>
     * }|DeliveryListAttemptsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeliveryListAttemptsResponse>
     *
     * @throws APIException
     */
    public function listAttempts(
        string $deliveryID,
        array|DeliveryListAttemptsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DeliveryListAttemptsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['webhooks/deliveries/%1$s/attempts', $deliveryID],
            query: $parsed,
            options: $options,
            convert: DeliveryListAttemptsResponse::class,
        );
    }

    /**
     * @api
     *
     * Queue an immediate attempt without rerunning or billing the underlying batch or monitor. A waiting retry is brought forward. A failed delivery gets one additional attempt without restarting its automatic retry budget. Set force: true to resend an acknowledged delivery. An in-progress attempt cannot be duplicated. The stored event body, event ID, and creation time remain unchanged; each attempt receives a fresh signature. Monitor retries use the current URL and secret; removing the webhook cancels pending deliveries. Batch result URLs in old payloads may have expired: retrieve the batch to get fresh URLs. Replay is available for seven days. A successful attempt cancels remaining automatic retries. Idempotency-Key is scoped to your organization and retained with the delivery metadata; repeating the same key and input returns the original accepted response.
     *
     * @param string $deliveryID Path param
     * @param array{
     *   force?: bool, tags?: list<string>, idempotencyKey?: string
     * }|DeliveryRetryParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeliveryRetryResponse>
     *
     * @throws APIException
     */
    public function retry(
        string $deliveryID,
        array|DeliveryRetryParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DeliveryRetryParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['idempotencyKey' => 'Idempotency-Key'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['webhooks/deliveries/%1$s/retry', $deliveryID],
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: DeliveryRetryResponse::class,
        );
    }
}
