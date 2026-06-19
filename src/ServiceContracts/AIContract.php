<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\AI\AIAIQueryParams\DataToExtract;
use ContextDev\AI\AIAIQueryParams\SpecificPages;
use ContextDev\AI\AIAIQueryResponse;
use ContextDev\AI\AIExtractProductResponse;
use ContextDev\AI\AIExtractProductsResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;

/**
 * @phpstan-import-type DataToExtractShape from \ContextDev\AI\AIAIQueryParams\DataToExtract
 * @phpstan-import-type SpecificPagesShape from \ContextDev\AI\AIAIQueryParams\SpecificPages
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface AIContract
{
    /**
     * @api
     *
     * @param list<DataToExtract|DataToExtractShape> $dataToExtract Array of data points to extract from the website
     * @param string $domain The domain name to analyze
     * @param SpecificPages|SpecificPagesShape $specificPages Optional object specifying which pages to analyze
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function aiQuery(
        array $dataToExtract,
        string $domain,
        SpecificPages|array|null $specificPages = null,
        ?int $timeoutMs = null,
        RequestOptions|array|null $requestOptions = null,
    ): AIAIQueryResponse;

    /**
     * @api
     *
     * @param string $url the product page URL to extract product data from
     * @param int $maxAgeMs Return a cached result if a prior scrape for the same parameters exists and is younger than this many milliseconds. Defaults to 7 days (604800000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always scrape fresh.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function extractProduct(
        string $url,
        int $maxAgeMs = 604800000,
        ?int $timeoutMs = null,
        RequestOptions|array|null $requestOptions = null,
    ): AIExtractProductResponse;

    /**
     * @api
     *
     * @param string $domain the domain name to analyze
     * @param string $directURL a specific URL to use directly as the starting point for extraction without domain resolution
     * @param int $maxAgeMs Return a cached result if a prior scrape for the same parameters exists and is younger than this many milliseconds. Defaults to 7 days (604800000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always scrape fresh.
     * @param int $maxProducts maximum number of products to extract
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function extractProducts(
        string $domain,
        string $directURL,
        int $maxAgeMs = 604800000,
        ?int $maxProducts = null,
        ?int $timeoutMs = null,
        RequestOptions|array|null $requestOptions = null,
    ): AIExtractProductsResponse;
}
