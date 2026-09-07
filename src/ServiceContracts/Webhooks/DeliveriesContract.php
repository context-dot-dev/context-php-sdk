<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts\Webhooks;

use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;
use ContextDev\Webhooks\Deliveries\DeliveryGetResponse;
use ContextDev\Webhooks\Deliveries\DeliveryListAttemptsResponse;
use ContextDev\Webhooks\Deliveries\DeliveryListParams\Status;
use ContextDev\Webhooks\Deliveries\DeliveryListResponse;
use ContextDev\Webhooks\Deliveries\DeliveryRetryResponse;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface DeliveriesContract
{
    /**
     * @api
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
    ): DeliveryGetResponse;

    /**
     * @api
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
    ): DeliveryListResponse;

    /**
     * @api
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
    ): DeliveryListAttemptsResponse;

    /**
     * @api
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
    ): DeliveryRetryResponse;
}
