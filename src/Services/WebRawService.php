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
use ContextDev\Web\WebExtractFontsParams;
use ContextDev\Web\WebExtractFontsResponse;
use ContextDev\Web\WebExtractParams;
use ContextDev\Web\WebExtractParams\Pdf;
use ContextDev\Web\WebExtractResponse;
use ContextDev\Web\WebExtractStyleguideParams;
use ContextDev\Web\WebExtractStyleguideParams\ColorScheme;
use ContextDev\Web\WebExtractStyleguideResponse;
use ContextDev\Web\WebScrapeParams;
use ContextDev\Web\WebScrapeParams\Formats;
use ContextDev\Web\WebScrapeParams\ImageParams;
use ContextDev\Web\WebScrapeParams\MarkdownParams;
use ContextDev\Web\WebScrapeParams\ParseParams;
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
use ContextDev\Web\WebWebCrawlMdResponse;
use ContextDev\Web\WebWebScrapeBytesParams;
use ContextDev\Web\WebWebScrapeBytesResponse;
use ContextDev\Web\WebWebScrapeHTMLParams;
use ContextDev\Web\WebWebScrapeHTMLResponse;
use ContextDev\Web\WebWebScrapeImagesParams;
use ContextDev\Web\WebWebScrapeImagesParams\Enrichment;
use ContextDev\Web\WebWebScrapeImagesResponse;
use ContextDev\Web\WebWebScrapeMdParams;
use ContextDev\Web\WebWebScrapeMdResponse;
use ContextDev\Web\WebWebScrapeScreenshotParams;
use ContextDev\Web\WebWebScrapeScreenshotResponse;
use ContextDev\Web\WebWebScrapeSitemapParams;
use ContextDev\Web\WebWebScrapeSitemapResponse;

/**
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebAnswersParams\TimeoutOpts
 * @phpstan-import-type ActionShape from \ContextDev\Web\WebExtractParams\Action
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebExtractParams\Pdf
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebExtractParams\TimeoutOpts as TimeoutOptsShape1
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebExtractCompetitorsParams\TimeoutOpts as TimeoutOptsShape2
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebExtractFontsParams\TimeoutOpts as TimeoutOptsShape3
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebExtractStyleguideParams\TimeoutOpts as TimeoutOptsShape4
 * @phpstan-import-type FormatsShape from \ContextDev\Web\WebScrapeParams\Formats
 * @phpstan-import-type ImageParamsShape from \ContextDev\Web\WebScrapeParams\ImageParams
 * @phpstan-import-type MarkdownParamsShape from \ContextDev\Web\WebScrapeParams\MarkdownParams
 * @phpstan-import-type ParseParamsShape from \ContextDev\Web\WebScrapeParams\ParseParams
 * @phpstan-import-type ScreenshotParamsShape from \ContextDev\Web\WebScrapeParams\ScreenshotParams
 * @phpstan-import-type SharedParamsShape from \ContextDev\Web\WebScrapeParams\SharedParams
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebScreenshotParams\TimeoutOpts as TimeoutOptsShape5
 * @phpstan-import-type ViewportShape from \ContextDev\Web\WebScreenshotParams\Viewport
 * @phpstan-import-type MarkdownOptionsShape from \ContextDev\Web\WebSearchParams\MarkdownOptions
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebSearchParams\TimeoutOpts as TimeoutOptsShape6
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebWebCrawlMdParams\Pdf as PdfShape1
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebWebCrawlMdParams\TimeoutOpts as TimeoutOptsShape7
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebWebScrapeBytesParams\TimeoutOpts as TimeoutOptsShape8
 * @phpstan-import-type ActionShape from \ContextDev\Web\WebWebScrapeHTMLParams\Action as ActionShape1
 * @phpstan-import-type ExtractRuleShape from \ContextDev\Web\WebWebScrapeHTMLParams\ExtractRule
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebWebScrapeHTMLParams\Pdf as PdfShape2
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebWebScrapeHTMLParams\TimeoutOpts as TimeoutOptsShape9
 * @phpstan-import-type ActionShape from \ContextDev\Web\WebWebScrapeImagesParams\Action as ActionShape2
 * @phpstan-import-type EnrichmentShape from \ContextDev\Web\WebWebScrapeImagesParams\Enrichment
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebWebScrapeImagesParams\TimeoutOpts as TimeoutOptsShape10
 * @phpstan-import-type ActionShape from \ContextDev\Web\WebWebScrapeMdParams\Action as ActionShape3
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebWebScrapeMdParams\Pdf as PdfShape3
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebWebScrapeMdParams\TimeoutOpts as TimeoutOptsShape11
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebWebScrapeScreenshotParams\TimeoutOpts as TimeoutOptsShape12
 * @phpstan-import-type ViewportShape from \ContextDev\Web\WebWebScrapeScreenshotParams\Viewport as ViewportShape1
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebWebScrapeSitemapParams\TimeoutOpts as TimeoutOptsShape13
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
     * Crawl a website, use the provided JSON Schema and instructions to prioritize relevant internal links, and extract structured data from the selected pages.
     *
     * @param array{
     *   schema: array<string,mixed>,
     *   url: string,
     *   actions?: list<ActionShape>,
     *   factCheck?: bool,
     *   followSubdomains?: bool,
     *   includeFrames?: bool,
     *   instructions?: string,
     *   maxAgeMs?: int,
     *   maxDepth?: int,
     *   maxPages?: int,
     *   pdf?: Pdf|PdfShape,
     *   settleAnimations?: bool,
     *   stopAfterMs?: int,
     *   tags?: list<string>,
     *   timeoutOpts?: WebExtractParams\TimeoutOpts|TimeoutOptsShape1,
     *   waitForMs?: int,
     *   zdr?: WebExtractParams\Zdr|value-of<WebExtractParams\Zdr>,
     * }|WebExtractParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebExtractResponse>
     *
     * @throws APIException
     */
    public function extract(
        array|WebExtractParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebExtractParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'web/extract',
            body: (object) $parsed,
            options: $options,
            convert: WebExtractResponse::class,
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
     *   timeoutOpts?: WebExtractCompetitorsParams\TimeoutOpts|TimeoutOptsShape2,
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
     * Scrape font information from a website including font families, usage statistics, fallbacks, and element/word counts.
     *
     * @param array{
     *   directURL?: string,
     *   domain?: string,
     *   maxAgeMs?: int|null,
     *   tags?: list<string>,
     *   timeoutOpts?: WebExtractFontsParams\TimeoutOpts|TimeoutOptsShape3,
     * }|WebExtractFontsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebExtractFontsResponse>
     *
     * @throws APIException
     */
    public function extractFonts(
        array|WebExtractFontsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebExtractFontsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'web/fonts',
            query: Util::array_transform_keys($parsed, ['directURL' => 'directUrl']),
            options: $options,
            convert: WebExtractFontsResponse::class,
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
     *   timeoutOpts?: WebExtractStyleguideParams\TimeoutOpts|TimeoutOptsShape4,
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
     * Capture the requested formats from one page visit. Shared settings apply once. HTML-only requests use the existing fast acquisition path. One credit per capture, or two with browser actions; PDF OCR adds one credit per recovered page. Original response bytes and screenshots are limited to 20 MiB each, screenshots to 40 megapixels, and the combined browser capture to 60 MiB.
     *
     * @param array{
     *   formats: Formats|FormatsShape,
     *   url: string,
     *   imageParams?: ImageParams|ImageParamsShape,
     *   markdownParams?: MarkdownParams|MarkdownParamsShape,
     *   maxAgeMs?: int,
     *   parseParams?: ParseParams|ParseParamsShape,
     *   screenshotParams?: ScreenshotParams|ScreenshotParamsShape,
     *   sharedParams?: SharedParams|SharedParamsShape,
     *   tags?: list<string>,
     *   timeoutMs?: int,
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
     *   pdf?: WebWebCrawlMdParams\Pdf|PdfShape1,
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

    /**
     * @api
     *
     * Downloads a resource and returns its bytes as base64. Without waitForMs, returns the original HTTP response without image conversion, text extraction, or character-encoding changes. HTTP compression is decoded before base64 encoding. Supply waitForMs to render HTML with JavaScript in the browser and return the resulting HTML as UTF-8 bytes after the wait. Non-HTML resources, including images and PDFs, keep their original bytes and do not incur a browser wait. Follows public redirects and retries failed downloads through ISP and residential proxies, with a direct fallback. When country is specified, only a residential proxy in that country is used. Supply headers such as Referer for images that require a referring page. Cached results are reused according to maxAgeMs (default: 1 day; maximum: 30 days). Set maxAgeMs=0 to fetch fresh and refresh the cache. Cache identity includes the exact URL, country, waitForMs, and normalized outbound headers. Credential-bearing headers and zero data retention bypass cache reads and writes. cache_metadata reports hit, miss, or zdr and the cached result age in milliseconds. Maximum decoded resource size: 20 MiB (20971520 bytes), before base64 encoding. Successful requests cost 1 credit; errors are not billed.
     *
     * @param array{
     *   url: string,
     *   country?: value-of<WebWebScrapeBytesParams\Country>,
     *   headers?: array<string,string>,
     *   maxAgeMs?: int|null,
     *   tags?: list<string>,
     *   timeoutOpts?: WebWebScrapeBytesParams\TimeoutOpts|TimeoutOptsShape8,
     *   waitForMs?: int|null,
     *   zdr?: WebWebScrapeBytesParams\Zdr|value-of<WebWebScrapeBytesParams\Zdr>,
     * }|WebWebScrapeBytesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebWebScrapeBytesResponse>
     *
     * @throws APIException
     */
    public function webScrapeBytes(
        array|WebWebScrapeBytesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebWebScrapeBytesParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'web/scrape/bytes',
            query: $parsed,
            options: $options,
            convert: WebWebScrapeBytesResponse::class,
        );
    }

    /**
     * @api
     *
     * Scrapes the given URL and returns the HTML content of the page. Optional extractRules return deterministic structured data in extracted using CSS selectors, attributes, lists, and nested rules, without an LLM or additional credits. Rules run on the returned HTML after selector and main-content filtering. Send extractRules as a JSON-encoded query parameter. The base request costs 1 credit; requests with browser actions cost 2 credits. A request that hits its timeoutOpts.milliseconds deadline fails with 408 and is not billed, unless timeoutOpts.behavior=return-partial is set — then the page as rendered so far is returned with `finalDOMState: "still-loading"` and billed at the base cost of 1 credit.
     *
     * @param array{
     *   url: string,
     *   actions?: list<ActionShape1>|null,
     *   country?: value-of<WebWebScrapeHTMLParams\Country>,
     *   excludeSelectors?: list<string>|null,
     *   extractRules?: array<string,ExtractRuleShape>,
     *   headers?: array<string,string>,
     *   includeFrames?: bool,
     *   includeSelectors?: list<string>|null,
     *   maxAgeMs?: int|null,
     *   pdf?: WebWebScrapeHTMLParams\Pdf|PdfShape2,
     *   settleAnimations?: bool,
     *   tags?: list<string>,
     *   timeoutOpts?: WebWebScrapeHTMLParams\TimeoutOpts|TimeoutOptsShape9,
     *   useMainContentOnly?: bool,
     *   waitForMs?: int|null,
     *   zdr?: WebWebScrapeHTMLParams\Zdr|value-of<WebWebScrapeHTMLParams\Zdr>,
     * }|WebWebScrapeHTMLParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebWebScrapeHTMLResponse>
     *
     * @throws APIException
     */
    public function webScrapeHTML(
        array|WebWebScrapeHTMLParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebWebScrapeHTMLParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'web/scrape/html',
            query: $parsed,
            options: $options,
            convert: WebWebScrapeHTMLResponse::class,
        );
    }

    /**
     * @api
     *
     * Extract image assets from a web page, including standard URLs, inline SVGs, data URIs, responsive image sources, metadata, CSS backgrounds, video posters, and embeds. The base request costs 1 credit, or 2 credits with browser actions. When enrichment is enabled, the entire call costs 5 credits, including requests that also use actions.
     *
     * @param array{
     *   url: string,
     *   actions?: list<ActionShape2>|null,
     *   country?: value-of<WebWebScrapeImagesParams\Country>,
     *   dedupe?: bool,
     *   enrichment?: Enrichment|EnrichmentShape|null,
     *   headers?: array<string,string>,
     *   maxAgeMs?: int|null,
     *   tags?: list<string>,
     *   timeoutOpts?: WebWebScrapeImagesParams\TimeoutOpts|TimeoutOptsShape10,
     *   waitForMs?: int|null,
     *   zdr?: WebWebScrapeImagesParams\Zdr|value-of<WebWebScrapeImagesParams\Zdr>,
     * }|WebWebScrapeImagesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebWebScrapeImagesResponse>
     *
     * @throws APIException
     */
    public function webScrapeImages(
        array|WebWebScrapeImagesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebWebScrapeImagesParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'web/scrape/images',
            query: $parsed,
            options: $options,
            convert: WebWebScrapeImagesResponse::class,
        );
    }

    /**
     * @api
     *
     * Scrapes the given URL into LLM usable Markdown. Inspect key_metadata on JSON responses from a recognized API key; use error_code to distinguish stable failure categories.
     *
     * ### YouTube
     *
     * YouTube URLs return the video or channel itself rather than the surrounding player and navigation chrome. A URL addressing a single video (`/watch`, `youtu.be`, `/shorts`, `/embed`, `/live`) returns its title, channel, duration, view count, keywords, full description, and the transcript when the video has captions that can be retrieved; videos without captions return everything except the transcript. A channel URL (`/channel/UC…`, `/@handle`, `/c/…`, `/user/…`) returns its name, handle, subscriber count, video count, and full description. When `includeImages=true`, video responses also include the thumbnail and channel responses include the avatar. Costs the same as any other scrape.
     *
     * ### Billing & errors
     *
     * | HTTP status | Billed? | Meaning |
     * | --- | --- | --- |
     * | 200 | Yes — 1 credit, or 2 credits with actions | Successful scrape, including a zero-length result when includeSelectors matched nothing. A partial result (`finalDOMState: "still-loading"`, only with timeoutOpts.behavior=return-partial) is billed at the base 1 credit with no OCR or actions surcharge |
     * | 400 | No | Invalid input, skipped PDF, or the page could not be scraped. error_code WEBSITE_BLOCKED specifically means the site answered with an anti-bot challenge, CAPTCHA wall, or login shell instead of the page (even when the site returned HTTP 200) — retrying later or from another country sometimes succeeds |
     * | 401 / 403 | No | Invalid/disabled key, insufficient permissions, or credits exhausted; inspect error_code |
     * | 404 | Yes — 1 credit, or 2 credits with actions | Target page returned or fingerprinted as not found |
     * | 408 | No | Request timed out. With timeoutOpts.behavior=return-partial this only happens when nothing usable had rendered by the deadline |
     * | 413 | No | Target content exceeds the maximum supported size (20 MB) |
     * | 415 | No | Unsupported content type |
     * | 429 | No | Per-minute rate limit exceeded; honor Retry-After |
     * | 500 | No | Internal error |
     *
     * @param array{
     *   url: string,
     *   actions?: list<ActionShape3>|null,
     *   country?: value-of<WebWebScrapeMdParams\Country>,
     *   excludeSelectors?: list<string>|null,
     *   headers?: array<string,string>,
     *   includeFrames?: bool,
     *   includeHTML?: bool,
     *   includeImages?: bool,
     *   includeLinks?: bool,
     *   includeSelectors?: list<string>|null,
     *   maxAgeMs?: int|null,
     *   pdf?: WebWebScrapeMdParams\Pdf|PdfShape3,
     *   settleAnimations?: bool,
     *   shortenBase64Images?: bool,
     *   tags?: list<string>,
     *   timeoutOpts?: WebWebScrapeMdParams\TimeoutOpts|TimeoutOptsShape11,
     *   useMainContentOnly?: bool,
     *   waitForMs?: int|null,
     *   zdr?: WebWebScrapeMdParams\Zdr|value-of<WebWebScrapeMdParams\Zdr>,
     * }|WebWebScrapeMdParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebWebScrapeMdResponse>
     *
     * @throws APIException
     */
    public function webScrapeMd(
        array|WebWebScrapeMdParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebWebScrapeMdParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'web/scrape/markdown',
            query: $parsed,
            options: $options,
            convert: WebWebScrapeMdResponse::class,
        );
    }

    /**
     * @api
     *
     * Capture the given HTTP or HTTPS URL with configurable viewport, full-page capture, wait time, popup handling, theme, scroll offset, cache age, country, and request timeout. Defaults to a 1920x1080 viewport, a 3-second wait, and a cache age of 1 day. With timeoutOpts.behavior=return-partial, a screenshot of the page rendered so far may be returned; inspect finalDOMState to identify an incomplete render. Successful requests cost 1 credit; errors are not billed.
     *
     * @param array{
     *   url: string,
     *   clearPopups?: bool,
     *   colorScheme?: WebWebScrapeScreenshotParams\ColorScheme|value-of<WebWebScrapeScreenshotParams\ColorScheme>,
     *   country?: value-of<WebWebScrapeScreenshotParams\Country>,
     *   fullScreenshot?: WebWebScrapeScreenshotParams\FullScreenshot|value-of<WebWebScrapeScreenshotParams\FullScreenshot>,
     *   handleCookiePopup?: bool,
     *   headers?: array<string,string>,
     *   maxAgeMs?: int|null,
     *   scrollOffset?: int|null,
     *   tags?: list<string>,
     *   timeoutOpts?: WebWebScrapeScreenshotParams\TimeoutOpts|TimeoutOptsShape12,
     *   viewport?: WebWebScrapeScreenshotParams\Viewport|ViewportShape1,
     *   waitForMs?: int|null,
     *   zdr?: WebWebScrapeScreenshotParams\Zdr|value-of<WebWebScrapeScreenshotParams\Zdr>,
     * }|WebWebScrapeScreenshotParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebWebScrapeScreenshotResponse>
     *
     * @throws APIException
     */
    public function webScrapeScreenshot(
        array|WebWebScrapeScreenshotParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebWebScrapeScreenshotParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'web/scrape/screenshot',
            query: $parsed,
            options: $options,
            convert: WebWebScrapeScreenshotResponse::class,
        );
    }

    /**
     * @api
     *
     * Crawl an entire website's sitemap and return all discovered page URLs. Set `includeSubdomains=true` to also discover public pages and sitemaps on child hosts such as `docs.example.com` or `brand.example.com`. Pass `search` to have the discovered URLs filtered down to the pages about a phrase (for example `pricing and plans` or `api authentication docs`), most relevant first — a searched crawl scans the whole sitemap and costs 2 credits instead of 1.
     *
     * @param array{
     *   domain: string,
     *   headers?: array<string,string>,
     *   includeSubdomains?: bool,
     *   maxLinks?: int,
     *   search?: string,
     *   sitemapURL?: string,
     *   tags?: list<string>,
     *   timeoutOpts?: WebWebScrapeSitemapParams\TimeoutOpts|TimeoutOptsShape13,
     *   urlRegex?: string,
     *   zdr?: WebWebScrapeSitemapParams\Zdr|value-of<WebWebScrapeSitemapParams\Zdr>,
     * }|WebWebScrapeSitemapParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebWebScrapeSitemapResponse>
     *
     * @throws APIException
     */
    public function webScrapeSitemap(
        array|WebWebScrapeSitemapParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebWebScrapeSitemapParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'web/scrape/sitemap',
            query: Util::array_transform_keys(
                $parsed,
                ['sitemapURL' => 'sitemapUrl']
            ),
            options: $options,
            convert: WebWebScrapeSitemapResponse::class,
        );
    }
}
