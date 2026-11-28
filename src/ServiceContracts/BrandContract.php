<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Brand\BrandGetResponse;
use ContextDev\Brand\BrandRetrieveParams\Country;
use ContextDev\Brand\BrandRetrieveParams\ForceLanguage;
use ContextDev\Brand\BrandRetrieveParams\TickerExchange;
use ContextDev\Brand\BrandRetrieveParams\TimeoutOpts;
use ContextDev\Brand\BrandRetrieveParams\Type;
use ContextDev\Brand\BrandRetrieveParams\Zdr;
use ContextDev\Brand\BrandSearchParams\Language;
use ContextDev\Brand\BrandSearchParams\QueryBy;
use ContextDev\Brand\BrandSearchResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;

/**
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Brand\BrandRetrieveParams\TimeoutOpts
 * @phpstan-import-type MccShape from \ContextDev\Brand\BrandRetrieveParams\Mcc
 * @phpstan-import-type PhoneShape from \ContextDev\Brand\BrandRetrieveParams\Phone
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface BrandContract
{
    /**
     * @api
     *
     * @param string $domain Domain of the brand, such as `stripe.com`.
     * @param Type|value-of<Type> $type set to `by_transaction` to identify the merchant behind a transaction descriptor
     * @param string $name company name, such as `Apple Inc`
     * @param string $email Work email address, such as `jane@stripe.com`. The brand is looked up from its domain.
     * @param string $ticker stock ticker symbol, such as `AAPL`
     * @param string $directURL Full `http` or `https` URL of the page to read, such as `https://stripe.com/enterprise`. Only this page is fetched.
     * @param string $transactionInfo transaction descriptor from a card or bank statement, such as `SQ *COFFEE SHOP`
     * @param ForceLanguage|value-of<ForceLanguage>|null $forceLanguage translate the brand's `title`, `description`, and `slogan` into this language
     * @param int $maxAgeMs Maximum age of cached brand data, in milliseconds. `0` always fetches fresh. Defaults to 90 days (7776000000 ms). Values above 1 year (31536000000 ms) are capped at 1 year.
     * @param bool $maxSpeed skip slower enrichment steps for a faster, less detailed response
     * @param list<string> $policies Access policy IDs to apply; each URL must pass all of them. Requires access policies enabled for your organization; otherwise returns `ACCESS_POLICIES_NOT_ENABLED`.
     * @param list<string> $tags Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
     * @param TimeoutOpts|TimeoutOptsShape $timeoutOpts request deadline and what to return when it passes
     * @param Zdr|value-of<Zdr> $zdr `enabled` turns off request logs and traces and keeps request and response content out of usage logs. Brand data and hosted assets may still be stored. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     * @param Country|value-of<Country> $country lowercase ISO 3166-1 alpha-2 country code, such as `us`
     * @param TickerExchange|value-of<TickerExchange> $tickerExchange stock exchange code, such as `NASDAQ` or `LSE`
     * @param string $city City where the transaction took place. Brands in this city are preferred.
     * @param bool $highConfidenceOnly run extra verification so the returned brand matches the transaction with high confidence
     * @param MccShape $mcc Merchant Category Code (MCC) from the transaction. Helps identify the type of business.
     * @param PhoneShape $phone Merchant phone number from the transaction. Helps confirm the match.
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
        ?array $policies = null,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
        Zdr|string|null $zdr = null,
        Country|string|null $country = null,
        TickerExchange|string|null $tickerExchange = null,
        ?string $city = null,
        ?bool $highConfidenceOnly = null,
        string|float|null $mcc = null,
        string|float|null $phone = null,
        RequestOptions|array|null $requestOptions = null,
    ): BrandGetResponse;

    /**
     * @api
     *
     * @param string $query Search term, matched against the fields in `queryBy`, such as `nike`, `nike.com`, or `nik`.
     * @param bool $autocomplete Match the search term as a prefix, so `nik` matches Nike while the user is still typing. Set to `false` to match whole words only.
     * @param \ContextDev\Brand\BrandSearchParams\Country|value-of<\ContextDev\Brand\BrandSearchParams\Country> $country only return brands in this country, as an uppercase ISO 3166-1 alpha-2 code such as `US` or `GB`
     * @param Language|value-of<Language> $language only return brands with this primary language, such as `english` or `french`
     * @param list<QueryBy|value-of<QueryBy>> $queryBy Fields to match the search term against: `name`, `domain`, or both. Send a comma-separated list or repeat the parameter.
     * @param list<string> $tags Comma-separated labels for this request, such as `production,team-alpha`. Filter usage and request logs by them.
     * @param int $typoTolerance Maximum number of typos to tolerate when matching. `0` requires exact spelling.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function search(
        string $query,
        bool $autocomplete = true,
        \ContextDev\Brand\BrandSearchParams\Country|string|null $country = null,
        Language|string|null $language = null,
        array $queryBy = ['name', 'domain'],
        ?array $tags = null,
        int $typoTolerance = 0,
        RequestOptions|array|null $requestOptions = null,
    ): BrandSearchResponse;
}
