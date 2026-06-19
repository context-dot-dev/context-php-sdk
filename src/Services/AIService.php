<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\AI\AIAIQueryParams\DataToExtract;
use ContextDev\AI\AIAIQueryParams\SpecificPages;
use ContextDev\AI\AIAIQueryResponse;
use ContextDev\AI\AIExtractProductResponse;
use ContextDev\AI\AIExtractProductsResponse;
use ContextDev\Client;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\AIContract;

/**
 * @phpstan-import-type DataToExtractShape from \ContextDev\AI\AIAIQueryParams\DataToExtract
 * @phpstan-import-type SpecificPagesShape from \ContextDev\AI\AIAIQueryParams\SpecificPages
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class AIService implements AIContract
{
    /**
     * @api
     */
    public AIRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AIRawService($client);
    }

    /**
     * @api
     *
     * Use AI to extract specific data points from a brand's website. The AI will crawl the website and extract the requested information based on the provided data points.
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
    ): AIAIQueryResponse {
        $params = Util::removeNulls(
            [
                'dataToExtract' => $dataToExtract,
                'domain' => $domain,
                'specificPages' => $specificPages,
                'timeoutMs' => $timeoutMs,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->aiQuery(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Given a single URL, determines if it is a product page and extracts the product information.
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
    ): AIExtractProductResponse {
        $params = Util::removeNulls(
            ['url' => $url, 'maxAgeMs' => $maxAgeMs, 'timeoutMs' => $timeoutMs]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->extractProduct(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Extract product information from a brand's website. We will analyze the website and return a list of products with details such as name, description, image, pricing, features, and more.
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
    ): AIExtractProductsResponse {
        $params = Util::removeNulls(
            [
                'domain' => $domain,
                'maxAgeMs' => $maxAgeMs,
                'maxProducts' => $maxProducts,
                'timeoutMs' => $timeoutMs,
                'directURL' => $directURL,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->extractProducts(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
