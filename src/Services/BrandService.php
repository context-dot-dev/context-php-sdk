<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Brand\BrandGetResponse;
use ContextDev\Brand\BrandGetSimplifiedResponse;
use ContextDev\Brand\BrandRetrieveParams\ForceLanguage;
use ContextDev\Brand\BrandRetrieveParams\Type;
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
     * Retrieve logos, backdrops, colors, industry, description, and more. Provide exactly one lookup identifier in the request body: a domain, company name, email address, stock ticker, or transaction descriptor.
     *
     * @param string $domain Domain name to retrieve brand data for (e.g., 'stripe.com').
     * @param Type|value-of<Type> $type discriminator for transaction-based brand retrieval
     * @param string $name Company name to retrieve brand data for (e.g., 'Apple Inc').
     * @param string $email Email address to retrieve brand data for (e.g., 'jane@stripe.com').
     * @param string $ticker Stock ticker symbol to retrieve brand data for (e.g., 'AAPL').
     * @param string $transactionInfo transaction information to identify the brand
     * @param ForceLanguage|value-of<ForceLanguage> $forceLanguage
     * @param int $maxAgeMs Maximum age in milliseconds for cached brand data before the API performs a hard refresh. Defaults to 3 months (7776000000 ms). Values below 1 day (86400000 ms) are clamped to 1 day; values above 1 year (31536000000 ms) are clamped to 1 year.
     * @param bool $maxSpeed Optional parameter to optimize the API call for maximum speed. When set to true, the API will skip time-consuming operations for faster response at the cost of less comprehensive data.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param string $countryGl optional country code hint (GL parameter) to specify the country when identifying a transaction
     * @param string $tickerExchange Optional stock exchange for the ticker. Defaults to NASDAQ if not specified.
     * @param string $city optional city name to prioritize when searching for the brand
     * @param bool $highConfidenceOnly when set to true, the API performs additional verification to ensure the identified brand matches the transaction with high confidence
     * @param int $mcc optional Merchant Category Code (MCC) to help identify the business category or industry
     * @param float $phone optional phone number from the transaction to help verify brand match
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $domain,
        Type|string $type,
        string $name,
        string $email,
        string $ticker,
        string $transactionInfo,
        ForceLanguage|string|null $forceLanguage = null,
        ?int $maxAgeMs = null,
        ?bool $maxSpeed = null,
        ?int $timeoutMs = null,
        ?string $countryGl = null,
        ?string $tickerExchange = null,
        ?string $city = null,
        ?bool $highConfidenceOnly = null,
        ?int $mcc = null,
        ?float $phone = null,
        RequestOptions|array|null $requestOptions = null,
    ): BrandGetResponse {
        $params = Util::removeNulls(
            [
                'domain' => $domain,
                'type' => $type,
                'forceLanguage' => $forceLanguage,
                'maxAgeMs' => $maxAgeMs,
                'maxSpeed' => $maxSpeed,
                'timeoutMs' => $timeoutMs,
                'name' => $name,
                'countryGl' => $countryGl,
                'email' => $email,
                'ticker' => $ticker,
                'tickerExchange' => $tickerExchange,
                'transactionInfo' => $transactionInfo,
                'city' => $city,
                'highConfidenceOnly' => $highConfidenceOnly,
                'mcc' => $mcc,
                'phone' => $phone,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(params: $params, requestOptions: $requestOptions);

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
