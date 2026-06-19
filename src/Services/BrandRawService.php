<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Brand\BrandGetByEmailResponse;
use ContextDev\Brand\BrandGetByIsinResponse;
use ContextDev\Brand\BrandGetByNameResponse;
use ContextDev\Brand\BrandGetByTickerResponse;
use ContextDev\Brand\BrandGetResponse;
use ContextDev\Brand\BrandGetSimplifiedResponse;
use ContextDev\Brand\BrandIdentifyFromTransactionParams;
use ContextDev\Brand\BrandIdentifyFromTransactionParams\CountryGl;
use ContextDev\Brand\BrandIdentifyFromTransactionResponse;
use ContextDev\Brand\BrandRetrieveByEmailParams;
use ContextDev\Brand\BrandRetrieveByIsinParams;
use ContextDev\Brand\BrandRetrieveByNameParams;
use ContextDev\Brand\BrandRetrieveByTickerParams;
use ContextDev\Brand\BrandRetrieveByTickerParams\TickerExchange;
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
     * Retrieve logos, backdrops, colors, industry, description, and more from any domain
     *
     * @param array{
     *   domain: string,
     *   forceLanguage?: value-of<ForceLanguage>,
     *   maxAgeMs?: int,
     *   maxSpeed?: bool,
     *   timeoutMs?: int,
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
            method: 'get',
            path: 'brand/retrieve',
            query: Util::array_transform_keys(
                $parsed,
                ['forceLanguage' => 'force_language', 'timeoutMs' => 'timeoutMS'],
            ),
            options: $options,
            convert: BrandGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Endpoint specially designed for platforms that want to identify transaction data by the transaction title.
     *
     * @param array{
     *   transactionInfo: string,
     *   city?: string,
     *   countryGl?: value-of<CountryGl>,
     *   forceLanguage?: value-of<BrandIdentifyFromTransactionParams\ForceLanguage>,
     *   highConfidenceOnly?: bool,
     *   maxSpeed?: bool,
     *   mcc?: string,
     *   phone?: float,
     *   timeoutMs?: int,
     * }|BrandIdentifyFromTransactionParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BrandIdentifyFromTransactionResponse>
     *
     * @throws APIException
     */
    public function identifyFromTransaction(
        array|BrandIdentifyFromTransactionParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BrandIdentifyFromTransactionParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'brand/transaction_identifier',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'transactionInfo' => 'transaction_info',
                    'countryGl' => 'country_gl',
                    'forceLanguage' => 'force_language',
                    'highConfidenceOnly' => 'high_confidence_only',
                    'timeoutMs' => 'timeoutMS',
                ],
            ),
            options: $options,
            convert: BrandIdentifyFromTransactionResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve brand information using an email address while detecting disposable and free email addresses. Disposable and free email addresses (like gmail.com, yahoo.com) will throw a 422 error.
     *
     * @param array{
     *   email: string,
     *   forceLanguage?: value-of<BrandRetrieveByEmailParams\ForceLanguage>,
     *   maxAgeMs?: int,
     *   maxSpeed?: bool,
     *   timeoutMs?: int,
     * }|BrandRetrieveByEmailParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BrandGetByEmailResponse>
     *
     * @throws APIException
     */
    public function retrieveByEmail(
        array|BrandRetrieveByEmailParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BrandRetrieveByEmailParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'brand/retrieve-by-email',
            query: Util::array_transform_keys(
                $parsed,
                ['forceLanguage' => 'force_language', 'timeoutMs' => 'timeoutMS'],
            ),
            options: $options,
            convert: BrandGetByEmailResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve brand information using an ISIN (International Securities Identification Number).
     *
     * @param array{
     *   isin: string,
     *   forceLanguage?: value-of<BrandRetrieveByIsinParams\ForceLanguage>,
     *   maxAgeMs?: int,
     *   maxSpeed?: bool,
     *   timeoutMs?: int,
     * }|BrandRetrieveByIsinParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BrandGetByIsinResponse>
     *
     * @throws APIException
     */
    public function retrieveByIsin(
        array|BrandRetrieveByIsinParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BrandRetrieveByIsinParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'brand/retrieve-by-isin',
            query: Util::array_transform_keys(
                $parsed,
                ['forceLanguage' => 'force_language', 'timeoutMs' => 'timeoutMS'],
            ),
            options: $options,
            convert: BrandGetByIsinResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve brand information using a company name.
     *
     * @param array{
     *   name: string,
     *   countryGl?: value-of<BrandRetrieveByNameParams\CountryGl>,
     *   forceLanguage?: value-of<BrandRetrieveByNameParams\ForceLanguage>,
     *   maxAgeMs?: int,
     *   maxSpeed?: bool,
     *   timeoutMs?: int,
     * }|BrandRetrieveByNameParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BrandGetByNameResponse>
     *
     * @throws APIException
     */
    public function retrieveByName(
        array|BrandRetrieveByNameParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BrandRetrieveByNameParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'brand/retrieve-by-name',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'countryGl' => 'country_gl',
                    'forceLanguage' => 'force_language',
                    'timeoutMs' => 'timeoutMS',
                ],
            ),
            options: $options,
            convert: BrandGetByNameResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve brand information using a stock ticker symbol.
     *
     * @param array{
     *   ticker: string,
     *   forceLanguage?: value-of<BrandRetrieveByTickerParams\ForceLanguage>,
     *   maxAgeMs?: int,
     *   maxSpeed?: bool,
     *   tickerExchange?: value-of<TickerExchange>,
     *   timeoutMs?: int,
     * }|BrandRetrieveByTickerParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BrandGetByTickerResponse>
     *
     * @throws APIException
     */
    public function retrieveByTicker(
        array|BrandRetrieveByTickerParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BrandRetrieveByTickerParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'brand/retrieve-by-ticker',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'forceLanguage' => 'force_language',
                    'tickerExchange' => 'ticker_exchange',
                    'timeoutMs' => 'timeoutMS',
                ],
            ),
            options: $options,
            convert: BrandGetByTickerResponse::class,
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
