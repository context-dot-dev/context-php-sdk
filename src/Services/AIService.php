<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\AI\AIExtractProductParams\TimeoutOpts;
use ContextDev\AI\AIExtractProductParams\Zdr;
use ContextDev\AI\AIExtractProductResponse;
use ContextDev\AI\AIExtractProductsResponse;
use ContextDev\Client;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\AIContract;

/**
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\AI\AIExtractProductParams\TimeoutOpts
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\AI\AIExtractProductsParams\TimeoutOpts as TimeoutOptsShape1
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
     * Given a single URL, determines if it is a product page and extracts the product information.
     *
     * @param string $url the product page URL to extract product data from
     * @param int $maxAgeMs Return a cached result if a prior scrape for the same parameters exists and is younger than this many milliseconds. Defaults to 7 days (604800000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always scrape fresh.
     * @param list<string> $tags Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
     * @param TimeoutOpts|TimeoutOptsShape $timeoutOpts Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     * @param Zdr|value-of<Zdr> $zdr Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Asset uploads are skipped, so hosted image URLs are omitted. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function extractProduct(
        string $url,
        int $maxAgeMs = 604800000,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
        Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): AIExtractProductResponse {
        $params = Util::removeNulls(
            [
                'url' => $url,
                'maxAgeMs' => $maxAgeMs,
                'tags' => $tags,
                'timeoutOpts' => $timeoutOpts,
                'zdr' => $zdr,
            ],
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
     * @param list<string> $tags Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
     * @param \ContextDev\AI\AIExtractProductsParams\TimeoutOpts|TimeoutOptsShape1 $timeoutOpts Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function extractProducts(
        string $domain,
        string $directURL,
        int $maxAgeMs = 604800000,
        ?int $maxProducts = null,
        ?array $tags = null,
        \ContextDev\AI\AIExtractProductsParams\TimeoutOpts|array|null $timeoutOpts = null,
        RequestOptions|array|null $requestOptions = null,
    ): AIExtractProductsResponse {
        $params = Util::removeNulls(
            [
                'domain' => $domain,
                'maxAgeMs' => $maxAgeMs,
                'maxProducts' => $maxProducts,
                'tags' => $tags,
                'timeoutOpts' => $timeoutOpts,
                'directURL' => $directURL,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->extractProducts(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
