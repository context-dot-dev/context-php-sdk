<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\WebRawContract;
use ContextDev\Web\WebAnswersParams;
use ContextDev\Web\WebAnswersParams\Mode;
use ContextDev\Web\WebAnswersParams\TimeoutOpts;
use ContextDev\Web\WebAnswersParams\Zdr;
use ContextDev\Web\WebAnswersResponse;
use ContextDev\Web\WebExtractCompetitorsParams;
use ContextDev\Web\WebExtractCompetitorsResponse;
use ContextDev\Web\WebExtractStyleguideParams;
use ContextDev\Web\WebExtractStyleguideParams\ColorScheme;
use ContextDev\Web\WebExtractStyleguideResponse;
use ContextDev\Web\WebMapURLsParams;
use ContextDev\Web\WebMapURLsResponse;
use ContextDev\Web\WebScrapeParams;
use ContextDev\Web\WebScrapeParams\Formats;
use ContextDev\Web\WebScrapeParams\HighlightsParams;
use ContextDev\Web\WebScrapeParams\ImageParams;
use ContextDev\Web\WebScrapeParams\JsonParams;
use ContextDev\Web\WebScrapeParams\MarkdownParams;
use ContextDev\Web\WebScrapeParams\ParseParams;
use ContextDev\Web\WebScrapeParams\ProductParams;
use ContextDev\Web\WebScrapeParams\ScreenshotParams;
use ContextDev\Web\WebScrapeParams\SharedParams;
use ContextDev\Web\WebScrapeResponse;
use ContextDev\Web\WebScreenshotParams;
use ContextDev\Web\WebScreenshotParams\Country;
use ContextDev\Web\WebScreenshotParams\FullScreenshot;
use ContextDev\Web\WebScreenshotParams\Page;
use ContextDev\Web\WebScreenshotParams\Viewport;
use ContextDev\Web\WebScreenshotResponse;
use ContextDev\Web\WebSearchParams;
use ContextDev\Web\WebSearchParams\Freshness;
use ContextDev\Web\WebSearchParams\MarkdownOptions;
use ContextDev\Web\WebSearchResponse;
use ContextDev\Web\WebWebCrawlMdParams;
use ContextDev\Web\WebWebCrawlMdParams\Pdf;
use ContextDev\Web\WebWebCrawlMdResponse;

/**
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebAnswersParams\TimeoutOpts
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebExtractCompetitorsParams\TimeoutOpts as TimeoutOptsShape1
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebExtractStyleguideParams\TimeoutOpts as TimeoutOptsShape2
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebMapURLsParams\TimeoutOpts as TimeoutOptsShape3
 * @phpstan-import-type FormatsShape from \ContextDev\Web\WebScrapeParams\Formats
 * @phpstan-import-type HighlightsParamsShape from \ContextDev\Web\WebScrapeParams\HighlightsParams
 * @phpstan-import-type ImageParamsShape from \ContextDev\Web\WebScrapeParams\ImageParams
 * @phpstan-import-type JsonParamsShape from \ContextDev\Web\WebScrapeParams\JsonParams
 * @phpstan-import-type MarkdownParamsShape from \ContextDev\Web\WebScrapeParams\MarkdownParams
 * @phpstan-import-type ParseParamsShape from \ContextDev\Web\WebScrapeParams\ParseParams
 * @phpstan-import-type ProductParamsShape from \ContextDev\Web\WebScrapeParams\ProductParams
 * @phpstan-import-type ScreenshotParamsShape from \ContextDev\Web\WebScrapeParams\ScreenshotParams
 * @phpstan-import-type SharedParamsShape from \ContextDev\Web\WebScrapeParams\SharedParams
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebScrapeParams\TimeoutOpts as TimeoutOptsShape4
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebScreenshotParams\TimeoutOpts as TimeoutOptsShape5
 * @phpstan-import-type ViewportShape from \ContextDev\Web\WebScreenshotParams\Viewport
 * @phpstan-import-type MarkdownOptionsShape from \ContextDev\Web\WebSearchParams\MarkdownOptions
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebSearchParams\TimeoutOpts as TimeoutOptsShape6
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebWebCrawlMdParams\Pdf
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebWebCrawlMdParams\TimeoutOpts as TimeoutOptsShape7
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class WebRawService implements WebRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Researches the live web and returns a sourced answer in your requested JSON shape. Select fast for a smaller research budget at 10 credits or ultra for deeper reasoning at 100 credits. Defaults to ultra. Fast research is limited to 30 seconds and ultra to 50 seconds; timeoutOpts.milliseconds can shorten either deadline.
     *
     * @param array{
     *   task: string,
     *   jsonFormat?: array<string,mixed>,
     *   mode?: Mode|value-of<Mode>,
     *   tags?: list<string>,
     *   timeoutOpts?: TimeoutOpts|TimeoutOptsShape,
     *   zdr?: Zdr|value-of<Zdr>,
     * }|WebAnswersParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebAnswersResponse>
     *
     * @throws APIException
     */
    public function answers(
        array|WebAnswersParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebAnswersParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'web/answers',
            body: (object) $parsed,
            options: $options,
            convert: WebAnswersResponse::class,
        );
    }

    /**
     * @api
     *
     * Analyze a company's landing page and web search evidence to return direct competitors for the same product or market.
     *
     * @param array{
     *   domain: string,
     *   numCompetitors?: int,
     *   tags?: list<string>,
     *   timeoutOpts?: WebExtractCompetitorsParams\TimeoutOpts|TimeoutOptsShape1,
     *   zdr?: WebExtractCompetitorsParams\Zdr|value-of<WebExtractCompetitorsParams\Zdr>,
     * }|WebExtractCompetitorsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebExtractCompetitorsResponse>
     *
     * @throws APIException
     */
    public function extractCompetitors(
        array|WebExtractCompetitorsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebExtractCompetitorsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'web/competitors',
            query: $parsed,
            options: $options,
            convert: WebExtractCompetitorsResponse::class,
        );
    }

    /**
     * @api
     *
     * Extract a comprehensive design system from a website including colors, typography, spacing, shadows, and UI components.
     *
     * @param array{
     *   colorScheme?: ColorScheme|value-of<ColorScheme>,
     *   directURL?: string,
     *   domain?: string,
     *   maxAgeMs?: int|null,
     *   tags?: list<string>,
     *   timeoutOpts?: WebExtractStyleguideParams\TimeoutOpts|TimeoutOptsShape2,
     *   zdr?: WebExtractStyleguideParams\Zdr|value-of<WebExtractStyleguideParams\Zdr>,
     * }|WebExtractStyleguideParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebExtractStyleguideResponse>
     *
     * @throws APIException
     */
    public function extractStyleguide(
        array|WebExtractStyleguideParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebExtractStyleguideParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'web/styleguide',
            query: Util::array_transform_keys($parsed, ['directURL' => 'directUrl']),
            options: $options,
            convert: WebExtractStyleguideResponse::class,
        );
    }

    /**
     * @api
     *
     * Discovers URLs using the same sitemap crawl, filters, and limits as /web/scrape/sitemap. Each URL includes its available title, description, keywords, and language. URLs without stored enrichment are returned immediately with only the URL and queued for background HTML scraping, so later requests can include their metadata. Responses are never cached as a whole; every request reads the current per-URL enrichment. Zero data retention and credential-bearing discovery requests return URLs without reading or storing shared enrichment or queuing background scrapes. Costs 1 credit, or 2 credits with search.
     *
     * @param array{
     *   domain: string,
     *   headers?: array<string,string>,
     *   includeSubdomains?: bool,
     *   maxLinks?: int,
     *   search?: string,
     *   sitemapURL?: string,
     *   tags?: list<string>,
     *   timeoutOpts?: WebMapURLsParams\TimeoutOpts|TimeoutOptsShape3,
     *   urlRegex?: string,
     *   zdr?: WebMapURLsParams\Zdr|value-of<WebMapURLsParams\Zdr>,
     * }|WebMapURLsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebMapURLsResponse>
     *
     * @throws APIException
     */
    public function mapUrls(
        array|WebMapURLsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebMapURLsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'web/urls',
            query: Util::array_transform_keys(
                $parsed,
                ['sitemapURL' => 'sitemapUrl']
            ),
            options: $options,
            convert: WebMapURLsResponse::class,
        );
    }

    /**
     * @api
     *
     * Reuse cached outputs independently and capture missing formats in one page visit. Each cache key includes only the settings that affect that output. HTML is shared with Markdown, parsed fields, product data, highlights, and JSON extraction. Cached outputs can come from different visits within maxAgeMs; use 0 for a fresh capture. HTML-only requests use the existing fast acquisition path. Highlights return the plain-text passages most relevant to highlightsParams.query. Requests with at least one successful output cost one base credit, including cache hits, or two with browser actions. All-failed responses are unbilled except missing pages, which retain the base price and the one-credit product charge when product was requested. Highlights add 3 credits when passages are returned. JSON extraction runs an LLM over nonempty page Markdown and adds four credits only when its result is returned successfully. PDF OCR adds one credit per recovered page on fresh extraction. Product adds one credit when its successful result is returned, plus six if that result used the specialized model. Original response bytes and screenshots are limited to 20 MiB each, screenshots to 40 megapixels, and the combined response to 60 MiB. An oversized output has success: false and data: null. If the combined response exceeds its limit, the largest outputs are marked failed until the remaining outputs fit. Valid captured pieces may still be cached when omitted to meet the response size limit.
     *
     * @param array{
     *   formats: Formats|FormatsShape,
     *   url: string,
     *   highlightsParams?: HighlightsParams|HighlightsParamsShape,
     *   imageParams?: ImageParams|ImageParamsShape,
     *   jsonParams?: JsonParams|JsonParamsShape,
     *   markdownParams?: MarkdownParams|MarkdownParamsShape,
     *   maxAgeMs?: int,
     *   parseParams?: ParseParams|ParseParamsShape,
     *   productParams?: ProductParams|ProductParamsShape,
     *   screenshotParams?: ScreenshotParams|ScreenshotParamsShape,
     *   sharedParams?: SharedParams|SharedParamsShape,
     *   tags?: list<string>,
     *   timeoutOpts?: WebScrapeParams\TimeoutOpts|TimeoutOptsShape4,
     *   zdr?: WebScrapeParams\Zdr|value-of<WebScrapeParams\Zdr>,
     * }|WebScrapeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebScrapeResponse>
     *
     * @throws APIException
     */
    public function scrape(
        array|WebScrapeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebScrapeParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'web/scrape',
            body: (object) $parsed,
            options: $options,
            convert: WebScrapeResponse::class,
        );
    }

    /**
     * @api
     *
     * Capture a screenshot of a website.
     *
     * @param array{
     *   clearPopups?: bool,
     *   colorScheme?: WebScreenshotParams\ColorScheme|value-of<WebScreenshotParams\ColorScheme>,
     *   country?: value-of<Country>,
     *   directURL?: string,
     *   domain?: string,
     *   fullScreenshot?: FullScreenshot|value-of<FullScreenshot>,
     *   handleCookiePopup?: bool,
     *   headers?: array<string,string>,
     *   maxAgeMs?: int|null,
     *   page?: Page|value-of<Page>,
     *   scrollOffset?: int|null,
     *   tags?: list<string>,
     *   timeoutOpts?: WebScreenshotParams\TimeoutOpts|TimeoutOptsShape5,
     *   viewport?: Viewport|ViewportShape,
     *   waitForMs?: int|null,
     *   zdr?: WebScreenshotParams\Zdr|value-of<WebScreenshotParams\Zdr>,
     * }|WebScreenshotParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebScreenshotResponse>
     *
     * @throws APIException
     */
    public function screenshot(
        array|WebScreenshotParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebScreenshotParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'web/screenshot',
            query: Util::array_transform_keys($parsed, ['directURL' => 'directUrl']),
            options: $options,
            convert: WebScreenshotResponse::class,
        );
    }

    /**
     * @api
     *
     * Search the web and optionally scrape each result to Markdown in one round-trip.
     *
     * @param array{
     *   query: string,
     *   country?: value-of<WebSearchParams\Country>,
     *   excludeDomains?: list<string>,
     *   freshness?: Freshness|value-of<Freshness>,
     *   includeDomains?: list<string>,
     *   markdownOptions?: MarkdownOptions|MarkdownOptionsShape,
     *   numResults?: int,
     *   queryFanout?: bool,
     *   tags?: list<string>,
     *   timeoutOpts?: WebSearchParams\TimeoutOpts|TimeoutOptsShape6,
     *   zdr?: WebSearchParams\Zdr|value-of<WebSearchParams\Zdr>,
     * }|WebSearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebSearchResponse>
     *
     * @throws APIException
     */
    public function search(
        array|WebSearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebSearchParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'web/search',
            body: (object) $parsed,
            options: $options,
            convert: WebSearchResponse::class,
        );
    }

    /**
     * @api
     *
     * Performs a crawl starting from a given URL, extracts page content as Markdown, and returns results for all crawled pages.
     *
     * @param array{
     *   url: string,
     *   country?: value-of<WebWebCrawlMdParams\Country>,
     *   excludeSelectors?: list<string>,
     *   followSubdomains?: bool,
     *   includeFrames?: bool,
     *   includeImages?: bool,
     *   includeLinks?: bool,
     *   includeSelectors?: list<string>,
     *   maxAgeMs?: int,
     *   maxDepth?: int,
     *   maxPages?: int,
     *   pdf?: Pdf|PdfShape,
     *   settleAnimations?: bool,
     *   shortenBase64Images?: bool,
     *   stopAfterMs?: int,
     *   tags?: list<string>,
     *   timeoutOpts?: WebWebCrawlMdParams\TimeoutOpts|TimeoutOptsShape7,
     *   urlRegex?: string,
     *   useMainContentOnly?: bool,
     *   waitForMs?: int,
     *   zdr?: WebWebCrawlMdParams\Zdr|value-of<WebWebCrawlMdParams\Zdr>,
     * }|WebWebCrawlMdParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebWebCrawlMdResponse>
     *
     * @throws APIException
     */
    public function webCrawlMd(
        array|WebWebCrawlMdParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebWebCrawlMdParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'web/crawl',
            body: (object) $parsed,
            options: $options,
            convert: WebWebCrawlMdResponse::class,
        );
    }
}
