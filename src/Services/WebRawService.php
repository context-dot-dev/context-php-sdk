<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\WebRawContract;
use ContextDev\Web\WebExtractCompetitorsParams;
use ContextDev\Web\WebExtractCompetitorsResponse;
use ContextDev\Web\WebExtractFontsParams;
use ContextDev\Web\WebExtractFontsResponse;
use ContextDev\Web\WebExtractParams;
use ContextDev\Web\WebExtractParams\Pdf;
use ContextDev\Web\WebExtractResponse;
use ContextDev\Web\WebExtractStyleguideParams;
use ContextDev\Web\WebExtractStyleguideResponse;
use ContextDev\Web\WebScreenshotParams;
use ContextDev\Web\WebScreenshotParams\FullScreenshot;
use ContextDev\Web\WebScreenshotParams\HandleCookiePopup;
use ContextDev\Web\WebScreenshotParams\Page;
use ContextDev\Web\WebScreenshotParams\Viewport;
use ContextDev\Web\WebScreenshotResponse;
use ContextDev\Web\WebSearchParams;
use ContextDev\Web\WebSearchParams\Freshness;
use ContextDev\Web\WebSearchParams\MarkdownOptions;
use ContextDev\Web\WebSearchResponse;
use ContextDev\Web\WebWebCrawlMdParams;
use ContextDev\Web\WebWebCrawlMdResponse;
use ContextDev\Web\WebWebScrapeHTMLParams;
use ContextDev\Web\WebWebScrapeHTMLResponse;
use ContextDev\Web\WebWebScrapeImagesParams;
use ContextDev\Web\WebWebScrapeImagesParams\Enrichment;
use ContextDev\Web\WebWebScrapeImagesResponse;
use ContextDev\Web\WebWebScrapeMdParams;
use ContextDev\Web\WebWebScrapeMdResponse;
use ContextDev\Web\WebWebScrapeSitemapParams;
use ContextDev\Web\WebWebScrapeSitemapResponse;

/**
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebExtractParams\Pdf
 * @phpstan-import-type ViewportShape from \ContextDev\Web\WebScreenshotParams\Viewport
 * @phpstan-import-type MarkdownOptionsShape from \ContextDev\Web\WebSearchParams\MarkdownOptions
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebWebCrawlMdParams\Pdf as PdfShape1
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebWebScrapeHTMLParams\Pdf as PdfShape2
 * @phpstan-import-type EnrichmentShape from \ContextDev\Web\WebWebScrapeImagesParams\Enrichment
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebWebScrapeMdParams\Pdf as PdfShape3
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
     * Crawl a website, use the provided JSON Schema and instructions to prioritize relevant internal links, and extract structured data from the selected pages.
     *
     * @param array{
     *   schema: array<string,mixed>,
     *   url: string,
     *   factCheck?: bool,
     *   followSubdomains?: bool,
     *   includeFrames?: bool,
     *   instructions?: string,
     *   maxAgeMs?: int,
     *   maxDepth?: int,
     *   maxPages?: int,
     *   pdf?: Pdf|PdfShape,
     *   stopAfterMs?: int,
     *   timeoutMs?: int,
     *   waitForMs?: int,
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
     *   domain: string, numCompetitors?: int, timeoutMs?: int
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
            query: Util::array_transform_keys($parsed, ['timeoutMs' => 'timeoutMS']),
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
     *   directURL?: string, domain?: string, maxAgeMs?: int, timeoutMs?: int
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
            query: Util::array_transform_keys(
                $parsed,
                ['directURL' => 'directUrl', 'timeoutMs' => 'timeoutMS']
            ),
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
     *   directURL?: string, domain?: string, maxAgeMs?: int, timeoutMs?: int
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
            query: Util::array_transform_keys(
                $parsed,
                ['directURL' => 'directUrl', 'timeoutMs' => 'timeoutMS']
            ),
            options: $options,
            convert: WebExtractStyleguideResponse::class,
        );
    }

    /**
     * @api
     *
     * Capture a screenshot of a website.
     *
     * @param array{
     *   directURL?: string,
     *   domain?: string,
     *   fullScreenshot?: FullScreenshot|value-of<FullScreenshot>,
     *   handleCookiePopup?: HandleCookiePopup|value-of<HandleCookiePopup>,
     *   maxAgeMs?: int,
     *   page?: Page|value-of<Page>,
     *   timeoutMs?: int,
     *   viewport?: Viewport|ViewportShape,
     *   waitForMs?: int,
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
            query: Util::array_transform_keys(
                $parsed,
                ['directURL' => 'directUrl', 'timeoutMs' => 'timeoutMS']
            ),
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
     *   excludeDomains?: list<string>,
     *   freshness?: Freshness|value-of<Freshness>,
     *   includeDomains?: list<string>,
     *   markdownOptions?: MarkdownOptions|MarkdownOptionsShape,
     *   queryFanout?: bool,
     *   timeoutMs?: int,
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
     *   shortenBase64Images?: bool,
     *   stopAfterMs?: int,
     *   timeoutMs?: int,
     *   urlRegex?: string,
     *   useMainContentOnly?: bool,
     *   waitForMs?: int,
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
     * Scrapes the given URL and returns the raw HTML content of the page.
     *
     * @param array{
     *   url: string,
     *   excludeSelectors?: list<string>,
     *   headers?: array<string,string>,
     *   includeFrames?: bool,
     *   includeSelectors?: list<string>,
     *   maxAgeMs?: int,
     *   pdf?: WebWebScrapeHTMLParams\Pdf|PdfShape2,
     *   timeoutMs?: int,
     *   useMainContentOnly?: bool,
     *   waitForMs?: int,
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
            query: Util::array_transform_keys($parsed, ['timeoutMs' => 'timeoutMS']),
            options: $options,
            convert: WebWebScrapeHTMLResponse::class,
        );
    }

    /**
     * @api
     *
     * Extract image assets from a web page, including standard URLs, inline SVGs, data URIs, responsive image sources, metadata, CSS backgrounds, video posters, and embeds. The base request costs 1 credit. When enrichment is enabled, the entire call costs 5 credits.
     *
     * @param array{
     *   url: string,
     *   enrichment?: Enrichment|EnrichmentShape,
     *   headers?: array<string,string>,
     *   maxAgeMs?: int,
     *   timeoutMs?: int,
     *   waitForMs?: int,
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
            query: Util::array_transform_keys($parsed, ['timeoutMs' => 'timeoutMS']),
            options: $options,
            convert: WebWebScrapeImagesResponse::class,
        );
    }

    /**
     * @api
     *
     * Scrapes the given URL into LLM usable Markdown.
     *
     * @param array{
     *   url: string,
     *   excludeSelectors?: list<string>,
     *   headers?: array<string,string>,
     *   includeFrames?: bool,
     *   includeImages?: bool,
     *   includeLinks?: bool,
     *   includeSelectors?: list<string>,
     *   maxAgeMs?: int,
     *   pdf?: WebWebScrapeMdParams\Pdf|PdfShape3,
     *   shortenBase64Images?: bool,
     *   timeoutMs?: int,
     *   useMainContentOnly?: bool,
     *   waitForMs?: int,
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
            query: Util::array_transform_keys($parsed, ['timeoutMs' => 'timeoutMS']),
            options: $options,
            convert: WebWebScrapeMdResponse::class,
        );
    }

    /**
     * @api
     *
     * Crawl an entire website's sitemap and return all discovered page URLs.
     *
     * @param array{
     *   domain: string,
     *   headers?: array<string,string>,
     *   maxLinks?: int,
     *   timeoutMs?: int,
     *   urlRegex?: string,
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
            query: Util::array_transform_keys($parsed, ['timeoutMs' => 'timeoutMS']),
            options: $options,
            convert: WebWebScrapeSitemapResponse::class,
        );
    }
}
