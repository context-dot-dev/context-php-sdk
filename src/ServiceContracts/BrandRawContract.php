<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Brand\BrandGetByEmailResponse;
use ContextDev\Brand\BrandGetByIsinResponse;
use ContextDev\Brand\BrandGetByNameResponse;
use ContextDev\Brand\BrandGetByTickerResponse;
use ContextDev\Brand\BrandGetResponse;
use ContextDev\Brand\BrandGetSimplifiedResponse;
use ContextDev\Brand\BrandIdentifyFromTransactionParams;
use ContextDev\Brand\BrandIdentifyFromTransactionResponse;
use ContextDev\Brand\BrandRetrieveByEmailParams;
use ContextDev\Brand\BrandRetrieveByIsinParams;
use ContextDev\Brand\BrandRetrieveByNameParams;
use ContextDev\Brand\BrandRetrieveByTickerParams;
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
     * @param array<string,mixed>|BrandIdentifyFromTransactionParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BrandIdentifyFromTransactionResponse>
     *
     * @throws APIException
     */
    public function identifyFromTransaction(
        array|BrandIdentifyFromTransactionParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|BrandRetrieveByEmailParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BrandGetByEmailResponse>
     *
     * @throws APIException
     */
    public function retrieveByEmail(
        array|BrandRetrieveByEmailParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|BrandRetrieveByIsinParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BrandGetByIsinResponse>
     *
     * @throws APIException
     */
    public function retrieveByIsin(
        array|BrandRetrieveByIsinParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|BrandRetrieveByNameParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BrandGetByNameResponse>
     *
     * @throws APIException
     */
    public function retrieveByName(
        array|BrandRetrieveByNameParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|BrandRetrieveByTickerParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BrandGetByTickerResponse>
     *
     * @throws APIException
     */
    public function retrieveByTicker(
        array|BrandRetrieveByTickerParams $params,
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
