<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Brand\BrandGetResponse;
use ContextDev\Brand\BrandGetSimplifiedResponse;
use ContextDev\Brand\BrandRetrieveParams;
use ContextDev\Brand\BrandRetrieveParams\ForceLanguage;
use ContextDev\Brand\BrandRetrieveSimplifiedParams;
use ContextDev\Client;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\BrandRawContract;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class BrandRawService implements BrandRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve logos, backdrops, colors, industry, description, and more. Provide exactly one lookup identifier in the request body: a domain, company name, email address, stock ticker, or transaction descriptor.
     *
     * @param array{
     *   domain: string,
     *   forceLanguage?: value-of<ForceLanguage>,
     *   maxAgeMs?: int,
     *   maxSpeed?: bool,
     *   timeoutMs?: int,
     *   name: string,
     *   countryGl?: string,
     *   email: string,
     *   ticker: string,
     *   tickerExchange?: string,
     *   transactionInfo: string,
     *   city?: string,
     *   highConfidenceOnly?: bool,
     *   mcc?: int,
     *   phone?: float,
     * }|BrandRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BrandGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        array|BrandRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BrandRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'brand/retrieve',
            body: (object) $parsed,
            options: $options,
            convert: BrandGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Returns a simplified version of brand data containing only essential information: domain, title, colors, logos, and backdrops. Optimized for faster responses and reduced data transfer.
     *
     * @param array{
     *   domain: string, maxAgeMs?: int, timeoutMs?: int
     * }|BrandRetrieveSimplifiedParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BrandGetSimplifiedResponse>
     *
     * @throws APIException
     */
    public function retrieveSimplified(
        array|BrandRetrieveSimplifiedParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BrandRetrieveSimplifiedParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'brand/retrieve-simplified',
            query: Util::array_transform_keys($parsed, ['timeoutMs' => 'timeoutMS']),
            options: $options,
            convert: BrandGetSimplifiedResponse::class,
        );
    }
}
