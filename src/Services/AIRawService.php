<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\AI\AIAIQueryParams;
use ContextDev\AI\AIAIQueryParams\DataToExtract;
use ContextDev\AI\AIAIQueryParams\SpecificPages;
use ContextDev\AI\AIAIQueryResponse;
use ContextDev\AI\AIExtractProductParams;
use ContextDev\AI\AIExtractProductResponse;
use ContextDev\AI\AIExtractProductsParams;
use ContextDev\AI\AIExtractProductsResponse;
use ContextDev\Client;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\AIRawContract;

/**
 * @phpstan-import-type DataToExtractShape from \ContextDev\AI\AIAIQueryParams\DataToExtract
 * @phpstan-import-type SpecificPagesShape from \ContextDev\AI\AIAIQueryParams\SpecificPages
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class AIRawService implements AIRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Use AI to extract specific data points from a brand's website. The AI will crawl the website and extract the requested information based on the provided data points.
     *
     * @param array{
     *   dataToExtract: list<DataToExtract|DataToExtractShape>,
     *   domain: string,
     *   specificPages?: SpecificPages|SpecificPagesShape,
     *   timeoutMs?: int,
     * }|AIAIQueryParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AIAIQueryResponse>
     *
     * @throws APIException
     */
    public function aiQuery(
        array|AIAIQueryParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AIAIQueryParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'brand/ai/query',
            body: (object) $parsed,
            options: $options,
            convert: AIAIQueryResponse::class,
        );
    }

    /**
     * @api
     *
     * Given a single URL, determines if it is a product page and extracts the product information.
     *
     * @param array{
     *   url: string, maxAgeMs?: int, timeoutMs?: int
     * }|AIExtractProductParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AIExtractProductResponse>
     *
     * @throws APIException
     */
    public function extractProduct(
        array|AIExtractProductParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AIExtractProductParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'brand/ai/product',
            body: (object) $parsed,
            options: $options,
            convert: AIExtractProductResponse::class,
        );
    }

    /**
     * @api
     *
     * Extract product information from a brand's website. We will analyze the website and return a list of products with details such as name, description, image, pricing, features, and more.
     *
     * @param array{
     *   domain: string,
     *   maxAgeMs?: int,
     *   maxProducts?: int,
     *   timeoutMs?: int,
     *   directURL: string,
     * }|AIExtractProductsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AIExtractProductsResponse>
     *
     * @throws APIException
     */
    public function extractProducts(
        array|AIExtractProductsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AIExtractProductsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'brand/ai/products',
            body: (object) $parsed,
            options: $options,
            convert: AIExtractProductsResponse::class,
        );
    }
}
