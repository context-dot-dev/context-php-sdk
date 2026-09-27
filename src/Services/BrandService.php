<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Brand\BrandGetResponse;
use ContextDev\Brand\BrandRetrieveParams\ForceLanguage;
use ContextDev\Brand\BrandRetrieveParams\TimeoutOpts;
use ContextDev\Brand\BrandRetrieveParams\Type;
use ContextDev\Brand\BrandSearchParams\QueryBy;
use ContextDev\Brand\BrandSearchResponse;
use ContextDev\Client;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\BrandContract;

/**
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Brand\BrandRetrieveParams\TimeoutOpts
 * @phpstan-import-type MccShape from \ContextDev\Brand\BrandRetrieveParams\Mcc
 * @phpstan-import-type PhoneShape from \ContextDev\Brand\BrandRetrieveParams\Phone
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
     * Retrieve logos, colors, company details, and social links using one lookup identifier. A direct URL limits extraction to that page.
     *
     * @param string $domain Domain name to retrieve brand data for (e.g., 'stripe.com').
     * @param Type|value-of<Type> $type discriminator for transaction-based brand retrieval
     * @param string $name Company name to retrieve brand data for (e.g., 'Apple Inc').
     * @param string $email Email address to retrieve brand data for (e.g., 'jane@stripe.com').
     * @param string $ticker Stock ticker symbol to retrieve brand data for (e.g., 'AAPL').
     * @param string $directURL Full http(s) URL to fetch brand data from (e.g., 'https://stripe.com/enterprise'). Only this URL is fetched — not the entire internet.
     * @param string $transactionInfo transaction information to identify the brand
     * @param ForceLanguage|value-of<ForceLanguage>|null $forceLanguage
     * @param int $maxAgeMs Maximum age of cached brand data in ms. Defaults to 3 months; clamped to 0–1 year. `0` refreshes.
     * @param bool $maxSpeed Optional parameter to optimize the API call for maximum speed. When set to true, the API will skip time-consuming operations for faster response at the cost of less comprehensive data.
     * @param list<string> $tags labels for filtering usage in the dashboard
     * @param TimeoutOpts|TimeoutOptsShape $timeoutOpts request deadline and what to return when it passes
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
        TimeoutOpts|array|null $timeoutOpts = null,
        ?string $countryGl = null,
        ?string $tickerExchange = null,
        ?string $city = null,
        ?bool $highConfidenceOnly = null,
        string|float|null $mcc = null,
        string|float|null $phone = null,
        RequestOptions|array|null $requestOptions = null,
    ): BrandGetResponse {
        $params = Util::removeNulls(
            [
                'domain' => $domain,
                'type' => $type,
                'forceLanguage' => $forceLanguage,
                'maxAgeMs' => $maxAgeMs,
                'maxSpeed' => $maxSpeed,
                'tags' => $tags,
                'timeoutOpts' => $timeoutOpts,
                'name' => $name,
                'countryGl' => $countryGl,
                'email' => $email,
                'ticker' => $ticker,
                'tickerExchange' => $tickerExchange,
                'directURL' => $directURL,
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
     * Find up to 10 brands by name or domain, ordered by popularity. Use the returned domain to retrieve a full brand profile.
     *
     * @param string $query Search term, matched against the fields selected by queryBy (e.g. 'nike', 'nike.com', 'nik').
     * @param bool $autocomplete Whether the search term matches by prefix, so partial words match as they are typed (e.g. 'nik' matches Nike). Set to false to match whole words only.
     * @param list<QueryBy|value-of<QueryBy>> $queryBy Fields to match the search term against, as a comma-separated list or repeated parameter: 'name', 'domain', or both. Defaults to both.
     * @param list<string> $tags Comma-separated labels for filtering usage, e.g. `production,team-alpha`.
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
    ): BrandSearchResponse {
        $params = Util::removeNulls(
            [
                'query' => $query,
                'autocomplete' => $autocomplete,
                'queryBy' => $queryBy,
                'tags' => $tags,
                'typoTolerance' => $typoTolerance,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->search(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
