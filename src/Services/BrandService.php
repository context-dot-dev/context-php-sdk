<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Brand\BrandGetByEmailResponse;
use ContextDev\Brand\BrandGetByIsinResponse;
use ContextDev\Brand\BrandGetByNameResponse;
use ContextDev\Brand\BrandGetByTickerResponse;
use ContextDev\Brand\BrandGetResponse;
use ContextDev\Brand\BrandGetSimplifiedResponse;
use ContextDev\Brand\BrandIdentifyFromTransactionParams\CountryGl;
use ContextDev\Brand\BrandIdentifyFromTransactionResponse;
use ContextDev\Brand\BrandRetrieveByTickerParams\TickerExchange;
use ContextDev\Brand\BrandRetrieveParams\ForceLanguage;
use ContextDev\Client;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\BrandContract;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class BrandService implements BrandContract
{
    /**
     * @api
     */
    public BrandRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BrandRawService($client);
    }

    /**
     * @api
     *
     * Retrieve logos, backdrops, colors, industry, description, and more from any domain
     *
     * @param string $domain Domain name to retrieve brand data for (e.g., 'example.com', 'google.com'). Cannot be used with name or ticker parameters.
     * @param ForceLanguage|value-of<ForceLanguage> $forceLanguage optional parameter to force the language of the retrieved brand data
     * @param int $maxAgeMs Maximum age in milliseconds for cached brand data before the API performs a hard refresh. Defaults to 3 months (7776000000 ms). Values below 1 day (86400000 ms) are clamped to 1 day; values above 1 year (31536000000 ms) are clamped to 1 year.
     * @param bool $maxSpeed Optional parameter to optimize the API call for maximum speed. When set to true, the API will skip time-consuming operations for faster response at the cost of less comprehensive data. Works with all three lookup methods.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $domain,
        ForceLanguage|string|null $forceLanguage = null,
        int $maxAgeMs = 7776000000,
        ?bool $maxSpeed = null,
        ?int $timeoutMs = null,
        RequestOptions|array|null $requestOptions = null,
    ): BrandGetResponse {
        $params = Util::removeNulls(
            [
                'domain' => $domain,
                'forceLanguage' => $forceLanguage,
                'maxAgeMs' => $maxAgeMs,
                'maxSpeed' => $maxSpeed,
                'timeoutMs' => $timeoutMs,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Endpoint specially designed for platforms that want to identify transaction data by the transaction title.
     *
     * @param string $transactionInfo Transaction information to identify the brand
     * @param string $city optional city name to prioritize when searching for the brand
     * @param CountryGl|value-of<CountryGl> $countryGl Optional country code (GL parameter) to specify the country. This affects the geographic location used for search queries.
     * @param \ContextDev\Brand\BrandIdentifyFromTransactionParams\ForceLanguage|value-of<\ContextDev\Brand\BrandIdentifyFromTransactionParams\ForceLanguage> $forceLanguage optional parameter to force the language of the retrieved brand data
     * @param bool $highConfidenceOnly when set to true, the API will perform an additional verification steps to ensure the identified brand matches the transaction with high confidence
     * @param bool $maxSpeed Optional parameter to optimize the API call for maximum speed. When set to true, the API will skip time-consuming operations for faster response at the cost of less comprehensive data.
     * @param string $mcc optional Merchant Category Code (MCC) to help identify the business category/industry
     * @param float $phone optional phone number from the transaction to help verify brand match
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function identifyFromTransaction(
        string $transactionInfo,
        ?string $city = null,
        CountryGl|string|null $countryGl = null,
        \ContextDev\Brand\BrandIdentifyFromTransactionParams\ForceLanguage|string|null $forceLanguage = null,
        bool $highConfidenceOnly = false,
        ?bool $maxSpeed = null,
        ?string $mcc = null,
        ?float $phone = null,
        ?int $timeoutMs = null,
        RequestOptions|array|null $requestOptions = null,
    ): BrandIdentifyFromTransactionResponse {
        $params = Util::removeNulls(
            [
                'transactionInfo' => $transactionInfo,
                'city' => $city,
                'countryGl' => $countryGl,
                'forceLanguage' => $forceLanguage,
                'highConfidenceOnly' => $highConfidenceOnly,
                'maxSpeed' => $maxSpeed,
                'mcc' => $mcc,
                'phone' => $phone,
                'timeoutMs' => $timeoutMs,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->identifyFromTransaction(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve brand information using an email address while detecting disposable and free email addresses. Disposable and free email addresses (like gmail.com, yahoo.com) will throw a 422 error.
     *
     * @param string $email Email address to retrieve brand data for (e.g., 'contact@example.com'). The domain will be extracted from the email. Free email providers (gmail.com, yahoo.com, etc.) and disposable email addresses are not allowed.
     * @param \ContextDev\Brand\BrandRetrieveByEmailParams\ForceLanguage|value-of<\ContextDev\Brand\BrandRetrieveByEmailParams\ForceLanguage> $forceLanguage optional parameter to force the language of the retrieved brand data
     * @param int $maxAgeMs Maximum age in milliseconds for cached brand data before the API performs a hard refresh. Defaults to 3 months (7776000000 ms). Values below 1 day (86400000 ms) are clamped to 1 day; values above 1 year (31536000000 ms) are clamped to 1 year.
     * @param bool $maxSpeed Optional parameter to optimize the API call for maximum speed. When set to true, the API will skip time-consuming operations for faster response at the cost of less comprehensive data.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveByEmail(
        string $email,
        \ContextDev\Brand\BrandRetrieveByEmailParams\ForceLanguage|string|null $forceLanguage = null,
        int $maxAgeMs = 7776000000,
        ?bool $maxSpeed = null,
        ?int $timeoutMs = null,
        RequestOptions|array|null $requestOptions = null,
    ): BrandGetByEmailResponse {
        $params = Util::removeNulls(
            [
                'email' => $email,
                'forceLanguage' => $forceLanguage,
                'maxAgeMs' => $maxAgeMs,
                'maxSpeed' => $maxSpeed,
                'timeoutMs' => $timeoutMs,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveByEmail(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve brand information using an ISIN (International Securities Identification Number).
     *
     * @param string $isin ISIN (International Securities Identification Number) to retrieve brand data for (e.g., 'AU000000IMD5', 'US0378331005'). Must be exactly 12 characters: 2 letters followed by 9 alphanumeric characters and ending with a digit.
     * @param \ContextDev\Brand\BrandRetrieveByIsinParams\ForceLanguage|value-of<\ContextDev\Brand\BrandRetrieveByIsinParams\ForceLanguage> $forceLanguage optional parameter to force the language of the retrieved brand data
     * @param int $maxAgeMs Maximum age in milliseconds for cached brand data before the API performs a hard refresh. Defaults to 3 months (7776000000 ms). Values below 1 day (86400000 ms) are clamped to 1 day; values above 1 year (31536000000 ms) are clamped to 1 year.
     * @param bool $maxSpeed Optional parameter to optimize the API call for maximum speed. When set to true, the API will skip time-consuming operations for faster response at the cost of less comprehensive data.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveByIsin(
        string $isin,
        \ContextDev\Brand\BrandRetrieveByIsinParams\ForceLanguage|string|null $forceLanguage = null,
        int $maxAgeMs = 7776000000,
        ?bool $maxSpeed = null,
        ?int $timeoutMs = null,
        RequestOptions|array|null $requestOptions = null,
    ): BrandGetByIsinResponse {
        $params = Util::removeNulls(
            [
                'isin' => $isin,
                'forceLanguage' => $forceLanguage,
                'maxAgeMs' => $maxAgeMs,
                'maxSpeed' => $maxSpeed,
                'timeoutMs' => $timeoutMs,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveByIsin(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve brand information using a company name.
     *
     * @param string $name Company name to retrieve brand data for (e.g., 'Apple Inc', 'Microsoft Corporation'). Must be 3-30 characters.
     * @param \ContextDev\Brand\BrandRetrieveByNameParams\CountryGl|value-of<\ContextDev\Brand\BrandRetrieveByNameParams\CountryGl> $countryGl optional country code hint (GL parameter) to specify the country for the company name
     * @param \ContextDev\Brand\BrandRetrieveByNameParams\ForceLanguage|value-of<\ContextDev\Brand\BrandRetrieveByNameParams\ForceLanguage> $forceLanguage optional parameter to force the language of the retrieved brand data
     * @param int $maxAgeMs Maximum age in milliseconds for cached brand data before the API performs a hard refresh. Defaults to 3 months (7776000000 ms). Values below 1 day (86400000 ms) are clamped to 1 day; values above 1 year (31536000000 ms) are clamped to 1 year.
     * @param bool $maxSpeed Optional parameter to optimize the API call for maximum speed. When set to true, the API will skip time-consuming operations for faster response at the cost of less comprehensive data.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveByName(
        string $name,
        \ContextDev\Brand\BrandRetrieveByNameParams\CountryGl|string|null $countryGl = null,
        \ContextDev\Brand\BrandRetrieveByNameParams\ForceLanguage|string|null $forceLanguage = null,
        int $maxAgeMs = 7776000000,
        ?bool $maxSpeed = null,
        ?int $timeoutMs = null,
        RequestOptions|array|null $requestOptions = null,
    ): BrandGetByNameResponse {
        $params = Util::removeNulls(
            [
                'name' => $name,
                'countryGl' => $countryGl,
                'forceLanguage' => $forceLanguage,
                'maxAgeMs' => $maxAgeMs,
                'maxSpeed' => $maxSpeed,
                'timeoutMs' => $timeoutMs,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveByName(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve brand information using a stock ticker symbol.
     *
     * @param string $ticker Stock ticker symbol to retrieve brand data for (e.g., 'AAPL', 'GOOGL', 'BRK.A'). Must be 1-15 characters, letters/numbers/dots only.
     * @param \ContextDev\Brand\BrandRetrieveByTickerParams\ForceLanguage|value-of<\ContextDev\Brand\BrandRetrieveByTickerParams\ForceLanguage> $forceLanguage optional parameter to force the language of the retrieved brand data
     * @param int $maxAgeMs Maximum age in milliseconds for cached brand data before the API performs a hard refresh. Defaults to 3 months (7776000000 ms). Values below 1 day (86400000 ms) are clamped to 1 day; values above 1 year (31536000000 ms) are clamped to 1 year.
     * @param bool $maxSpeed Optional parameter to optimize the API call for maximum speed. When set to true, the API will skip time-consuming operations for faster response at the cost of less comprehensive data.
     * @param TickerExchange|value-of<TickerExchange> $tickerExchange Optional stock exchange for the ticker. Defaults to NASDAQ if not specified.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveByTicker(
        string $ticker,
        \ContextDev\Brand\BrandRetrieveByTickerParams\ForceLanguage|string|null $forceLanguage = null,
        int $maxAgeMs = 7776000000,
        ?bool $maxSpeed = null,
        TickerExchange|string|null $tickerExchange = null,
        ?int $timeoutMs = null,
        RequestOptions|array|null $requestOptions = null,
    ): BrandGetByTickerResponse {
        $params = Util::removeNulls(
            [
                'ticker' => $ticker,
                'forceLanguage' => $forceLanguage,
                'maxAgeMs' => $maxAgeMs,
                'maxSpeed' => $maxSpeed,
                'tickerExchange' => $tickerExchange,
                'timeoutMs' => $timeoutMs,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveByTicker(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns a simplified version of brand data containing only essential information: domain, title, colors, logos, and backdrops. Optimized for faster responses and reduced data transfer.
     *
     * @param string $domain Domain name to retrieve simplified brand data for
     * @param int $maxAgeMs Maximum age in milliseconds for cached brand data before the API performs a hard refresh. Defaults to 3 months (7776000000 ms). Values below 1 day (86400000 ms) are clamped to 1 day; values above 1 year (31536000000 ms) are clamped to 1 year.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveSimplified(
        string $domain,
        int $maxAgeMs = 7776000000,
        ?int $timeoutMs = null,
        RequestOptions|array|null $requestOptions = null,
    ): BrandGetSimplifiedResponse {
        $params = Util::removeNulls(
            ['domain' => $domain, 'maxAgeMs' => $maxAgeMs, 'timeoutMs' => $timeoutMs]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveSimplified(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
