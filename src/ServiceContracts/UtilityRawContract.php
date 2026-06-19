<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;
use ContextDev\Utility\UtilityPrefetchByEmailParams;
use ContextDev\Utility\UtilityPrefetchByEmailResponse;
use ContextDev\Utility\UtilityPrefetchParams;
use ContextDev\Utility\UtilityPrefetchResponse;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface UtilityRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|UtilityPrefetchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UtilityPrefetchResponse>
     *
     * @throws APIException
     */
    public function prefetch(
        array|UtilityPrefetchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|UtilityPrefetchByEmailParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UtilityPrefetchByEmailResponse>
     *
     * @throws APIException
     */
    public function prefetchByEmail(
        array|UtilityPrefetchByEmailParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
