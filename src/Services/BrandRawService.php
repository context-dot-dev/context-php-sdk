<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Brand\BrandGetResponse;
use ContextDev\Brand\BrandGetSimplifiedResponse;
use ContextDev\Brand\BrandRetrieveParams;
use ContextDev\Brand\BrandRetrieveParams\ForceLanguage;
use ContextDev\Brand\BrandRetrieveParams\Type;
use ContextDev\Brand\BrandRetrieveSimplifiedParams;
use ContextDev\Brand\BrandRetrieveSimplifiedParams\Theme;
use ContextDev\Brand\BrandSearchParams;
use ContextDev\Brand\BrandSearchResponse;
use ContextDev\Client;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\BrandRawContract;

/**
 * @phpstan-import-type MccShape from \ContextDev\Brand\BrandRetrieveParams\Mcc
 * @phpstan-import-type PhoneShape from \ContextDev\Brand\BrandRetrieveParams\Phone
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
     * Retrieve logos, backdrops, colors, industry, description, and more. Provide exactly one lookup identifier in the request body: a domain, company name, email address, stock ticker, transaction descriptor, or direct URL. Note: `by_direct_url` fetches brand data only from the provided URL — not from the entire internet.
     *
     * @param array{
     *   domain: string,
     *   type: Type|value-of<Type>,
     *   forceLanguage?: value-of<ForceLanguage>,
     *   maxAgeMs?: int,
     *   maxSpeed?: bool,
     *   tags?: list<string>,
     *   timeoutMs?: int,
     *   name: string,
     *   countryGl?: string,
     *   email: string,
     *   ticker: string,
     *   tickerExchange?: string,
     *   directURL: string,
     *   transactionInfo: string,
     *   city?: string,
     *   highConfidenceOnly?: bool,
     *   mcc?: MccShape,
     *   phone?: PhoneShape,
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
     *   domain: string,
     *   maxAgeMs?: int|null,
     *   tags?: list<string>,
     *   theme?: Theme|value-of<Theme>,
     *   timeoutMs?: int,
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

    /**
     * @api
     *
     * Search brands by name or domain and get back up to 10 lightweight matches (domain, name, logo). Name matches rank ahead of domain matches; within each group the most popular brands come first: by Tranco rank, then market cap for brands outside the Tranco list, with text relevance breaking ties. Matching is prefix-based with no typo tolerance, so it is suited to autocomplete. Only brands already in the Context.dev index are returned — use /brand/retrieve to fetch (and index) a specific domain. Free on Pro and Scale plans; costs 1 credit per request on the Free and Starter plans.
     *
     * @param array{query: string, tags?: list<string>}|BrandSearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BrandSearchResponse>
     *
     * @throws APIException
     */
    public function search(
        array|BrandSearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BrandSearchParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'brand/search',
            query: $parsed,
            options: $options,
            convert: BrandSearchResponse::class,
        );
    }
}
