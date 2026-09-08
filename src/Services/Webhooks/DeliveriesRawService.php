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
use ContextDev\Webhooks\Deliveries\DeliveryListParams\Type;
use ContextDev\Webhooks\Deliveries\DeliveryListResponse;
use ContextDev\Webhooks\Deliveries\DeliveryRetrieveParams;
use ContextDev\Webhooks\Deliveries\DeliveryRetryParams;
use ContextDev\Webhooks\Deliveries\DeliveryRetryResponse;

/**
 * Inspect and retry webhook deliveries. These endpoints cost no credits.
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
     * Get a webhook delivery, including its status and latest attempt.
     *
     * @param string $deliveryID delivery ID
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
     * List your batch or monitor webhook deliveries, newest first.
     *
     * @param array{
     *   type: Type|value-of<Type>,
     *   batchID?: string,
     *   createdAfter?: \DateTimeInterface,
     *   cursor?: string,
     *   limit?: int,
     *   status?: Status|value-of<Status>,
     *   tags?: list<string>,
     *   monitorID?: string,
     *   runID?: string,
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
            method: 'post',
            path: 'webhooks/deliveries',
            body: (object) $parsed,
            options: $options,
            convert: DeliveryListResponse::class,
        );
    }

    /**
     * @api
     *
     * List delivery attempts, newest first.
     *
     * @param string $deliveryID delivery ID
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
     * Retry a webhook delivery within seven days of creation.
     *
     * @param string $deliveryID path param: Delivery ID
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
