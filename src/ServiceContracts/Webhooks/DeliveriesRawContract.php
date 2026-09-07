<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts\Webhooks;

use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;
use ContextDev\Webhooks\Deliveries\DeliveryGetResponse;
use ContextDev\Webhooks\Deliveries\DeliveryListAttemptsParams;
use ContextDev\Webhooks\Deliveries\DeliveryListAttemptsResponse;
use ContextDev\Webhooks\Deliveries\DeliveryListParams;
use ContextDev\Webhooks\Deliveries\DeliveryListResponse;
use ContextDev\Webhooks\Deliveries\DeliveryRetrieveParams;
use ContextDev\Webhooks\Deliveries\DeliveryRetryParams;
use ContextDev\Webhooks\Deliveries\DeliveryRetryResponse;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface DeliveriesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|DeliveryRetrieveParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|DeliveryListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeliveryListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|DeliveryListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|DeliveryListAttemptsParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $deliveryID Path param
     * @param array<string,mixed>|DeliveryRetryParams $params
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
    ): BaseResponse;
}
