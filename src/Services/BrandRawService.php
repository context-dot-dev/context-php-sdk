<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Brand\BrandGetResponse;
use ContextDev\Brand\BrandRetrieveParams;
use ContextDev\Brand\BrandRetrieveParams\Country;
use ContextDev\Brand\BrandRetrieveParams\ForceLanguage;
use ContextDev\Brand\BrandRetrieveParams\TickerExchange;
use ContextDev\Brand\BrandRetrieveParams\TimeoutOpts;
use ContextDev\Brand\BrandRetrieveParams\Type;
use ContextDev\Brand\BrandRetrieveParams\Zdr;
use ContextDev\Brand\BrandSearchParams;
use ContextDev\Brand\BrandSearchParams\Language;
use ContextDev\Brand\BrandSearchParams\QueryBy;
use ContextDev\Brand\BrandSearchResponse;
use ContextDev\Client;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\BrandRawContract;

/**
 * Retrieve a brand's logos, colors, company details, and social links, or find brands by name or domain.
 *
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
     * Look up a brand by domain, company name, work email, stock ticker, page URL, or card transaction descriptor. Returns logos, colors, backdrops, description, industries, address, stock listing, and social links. A `by_direct_url` lookup reads only that page.
     *
     * @param array{
     *   domain: string,
     *   type: Type|value-of<Type>,
     *   forceLanguage?: value-of<ForceLanguage>,
     *   maxAgeMs?: int,
     *   maxSpeed?: bool,
     *   policies?: list<string>,
     *   tags?: list<string>,
     *   timeoutOpts?: TimeoutOpts|TimeoutOptsShape,
     *   zdr?: Zdr|value-of<Zdr>,
     *   name: string,
     *   country?: value-of<Country>,
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
     * Autocomplete brand names and domains as a user types, with up to 10 brands ranked by popularity and a ready-to-use logo URL for each. Filter by country and primary language. Pass a returned `domain` to `POST /brand/retrieve` for the full brand profile.
     *
     * @param array{
     *   query: string,
     *   autocomplete?: bool,
     *   country?: value-of<BrandSearchParams\Country>,
     *   language?: value-of<Language>,
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
