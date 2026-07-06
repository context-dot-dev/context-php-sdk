<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Brand\BrandGetResponse;
use ContextDev\Brand\BrandGetSimplifiedResponse;
use ContextDev\Brand\BrandRetrieveParams;
use ContextDev\Brand\BrandRetrieveSimplifiedParams;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface BrandRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|BrandRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BrandGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        array|BrandRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|BrandRetrieveSimplifiedParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BrandGetSimplifiedResponse>
     *
     * @throws APIException
     */
    public function retrieveSimplified(
        array|BrandRetrieveSimplifiedParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
