<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Brand\BrandGetResponse;
use ContextDev\Brand\BrandGetSimplifiedResponse;
use ContextDev\Brand\BrandRetrieveParams\ForceLanguage;
use ContextDev\Brand\BrandRetrieveParams\Type;
use ContextDev\Brand\BrandRetrieveSimplifiedParams\Theme;
use ContextDev\Brand\BrandSearchParams\QueryBy;
use ContextDev\Brand\BrandSearchResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;

/**
 * @phpstan-import-type MccShape from \ContextDev\Brand\BrandRetrieveParams\Mcc
 * @phpstan-import-type PhoneShape from \ContextDev\Brand\BrandRetrieveParams\Phone
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface BrandContract
{
    /**
     * @api
     *
     * @param string $domain Domain name to retrieve brand data for (e.g., 'stripe.com').
     * @param Type|value-of<Type> $type discriminator for transaction-based brand retrieval
     * @param string $name Company name to retrieve brand data for (e.g., 'Apple Inc').
     * @param string $email Email address to retrieve brand data for (e.g., 'jane@stripe.com').
     * @param string $ticker Stock ticker symbol to retrieve brand data for (e.g., 'AAPL').
     * @param string $directURL Full http(s) URL to fetch brand data from (e.g., 'https://stripe.com/enterprise'). Only this URL is fetched — not the entire internet.
     * @param string $transactionInfo transaction information to identify the brand
     * @param ForceLanguage|value-of<ForceLanguage>|null $forceLanguage
     * @param int $maxAgeMs Maximum age in milliseconds for cached brand data before the API performs a hard refresh. Defaults to 3 months (7776000000 ms). Values below 1 day (86400000 ms) are clamped to 1 day; values above 1 year (31536000000 ms) are clamped to 1 year.
     * @param bool $maxSpeed Optional parameter to optimize the API call for maximum speed. When set to true, the API will skip time-consuming operations for faster response at the cost of less comprehensive data.
     * @param list<string> $tags Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param string $countryGl optional country code hint (GL parameter) to specify the country when identifying a transaction
     * @param string $tickerExchange Optional stock exchange for the ticker. Defaults to NASDAQ if not specified.
     * @param string $city optional city name to prioritize when searching for the brand
     * @param bool $highConfidenceOnly when set to true, the API performs additional verification to ensure the identified brand matches the transaction with high confidence
     * @param MccShape $mcc optional Merchant Category Code (MCC) to help identify the business category or industry
     * @param PhoneShape $phone optional phone number from the transaction to help verify brand match
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
        string $directURL,
        string $transactionInfo,
        ForceLanguage|string|null $forceLanguage = null,
        ?int $maxAgeMs = null,
        ?bool $maxSpeed = null,
        ?array $tags = null,
        ?int $timeoutMs = null,
        ?string $countryGl = null,
        ?string $tickerExchange = null,
        ?string $city = null,
        ?bool $highConfidenceOnly = null,
        string|float|null $mcc = null,
        string|float|null $phone = null,
        RequestOptions|array|null $requestOptions = null,
    ): BrandGetResponse;

    /**
     * @api
     *
     * @param string $domain Domain name to retrieve simplified brand data for
     * @param int|null $maxAgeMs Maximum age in milliseconds for cached brand data before the API performs a hard refresh. Defaults to 3 months (7776000000 ms). Values below 1 day (86400000 ms) are clamped to 1 day; values above 1 year (31536000000 ms) are clamped to 1 year.
     * @param list<string> $tags Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     * @param Theme|value-of<Theme> $theme optional theme preference used when selecting brand assets
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveSimplified(
        string $domain,
        ?int $maxAgeMs = 7776000000,
        ?array $tags = null,
        Theme|string|null $theme = null,
        ?int $timeoutMs = null,
        RequestOptions|array|null $requestOptions = null,
    ): BrandGetSimplifiedResponse;

    /**
     * @api
     *
     * @param string $query Search term, matched against the fields selected by queryBy (e.g. 'nike', 'nike.com', 'nik').
     * @param bool $autocomplete Whether the search term matches by prefix, so partial words match as they are typed (e.g. 'nik' matches Nike). Set to false to match whole words only.
     * @param list<QueryBy|value-of<QueryBy>> $queryBy Fields to match the search term against, as a comma-separated list or repeated parameter: 'name', 'domain', or both. Defaults to both.
     * @param list<string> $tags Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     * @param int $typoTolerance Maximum number of typos tolerated when matching, from 0 to 2. Defaults to 0 (no typo tolerance).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function search(
        string $query,
        bool $autocomplete = true,
        array $queryBy = ['name', 'domain'],
        ?array $tags = null,
        int $typoTolerance = 0,
        RequestOptions|array|null $requestOptions = null,
    ): BrandSearchResponse;
}
