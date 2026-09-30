<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Brand\BrandGetResponse;
use ContextDev\Brand\BrandRetrieveParams;
use ContextDev\Brand\BrandRetrieveParams\CountryGl;
use ContextDev\Brand\BrandRetrieveParams\ForceLanguage;
use ContextDev\Brand\BrandRetrieveParams\TickerExchange;
use ContextDev\Brand\BrandRetrieveParams\TimeoutOpts;
use ContextDev\Brand\BrandRetrieveParams\Type;
use ContextDev\Brand\BrandSearchParams;
use ContextDev\Brand\BrandSearchParams\QueryBy;
use ContextDev\Brand\BrandSearchResponse;
use ContextDev\Client;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\BrandRawContract;

/**
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Brand\BrandRetrieveParams\TimeoutOpts
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
     * Retrieve logos, colors, company details, and social links using one lookup identifier. A direct URL limits extraction to that page.
     *
     * @param array{
     *   domain: string,
     *   type: Type|value-of<Type>,
     *   forceLanguage?: value-of<ForceLanguage>,
     *   maxAgeMs?: int,
     *   maxSpeed?: bool,
     *   tags?: list<string>,
     *   timeoutOpts?: TimeoutOpts|TimeoutOptsShape,
     *   name: string,
     *   countryGl?: value-of<CountryGl>,
     *   email: string,
     *   ticker: string,
     *   tickerExchange?: value-of<TickerExchange>,
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
     * Find up to 10 brands by name or domain, ordered by popularity. Use the returned domain to retrieve a full brand profile.
     *
     * @param array{
     *   query: string,
     *   autocomplete?: bool,
     *   queryBy?: list<QueryBy|value-of<QueryBy>>,
     *   tags?: list<string>,
     *   typoTolerance?: int,
     * }|BrandSearchParams $params
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
