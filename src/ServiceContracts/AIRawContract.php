<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\AI\AIAIQueryParams;
use ContextDev\AI\AIAIQueryResponse;
use ContextDev\AI\AIExtractProductParams;
use ContextDev\AI\AIExtractProductResponse;
use ContextDev\AI\AIExtractProductsParams;
use ContextDev\AI\AIExtractProductsResponse;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface AIRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|AIAIQueryParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AIAIQueryResponse>
     *
     * @throws APIException
     */
    public function aiQuery(
        array|AIAIQueryParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AIExtractProductParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AIExtractProductResponse>
     *
     * @throws APIException
     */
    public function extractProduct(
        array|AIExtractProductParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AIExtractProductsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AIExtractProductsResponse>
     *
     * @throws APIException
     */
    public function extractProducts(
        array|AIExtractProductsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
