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
use ContextDev\Web\WebExtractStyleguideParams\ColorScheme;
use ContextDev\Web\WebExtractStyleguideResponse;
use ContextDev\Web\WebScreenshotParams;
use ContextDev\Web\WebScreenshotParams\Country;
use ContextDev\Web\WebScreenshotParams\FullScreenshot;
use ContextDev\Web\WebScreenshotParams\Page;
use ContextDev\Web\WebScreenshotParams\Viewport;
use ContextDev\Web\WebScreenshotParams\Zdr;
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
 * @phpstan-import-type ActionShape from \ContextDev\Web\WebExtractParams\Action
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebExtractParams\Pdf
 * @phpstan-import-type ViewportShape from \ContextDev\Web\WebScreenshotParams\Viewport
 * @phpstan-import-type MarkdownOptionsShape from \ContextDev\Web\WebSearchParams\MarkdownOptions
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebWebCrawlMdParams\Pdf as PdfShape1
 * @phpstan-import-type ActionShape from \ContextDev\Web\WebWebScrapeHTMLParams\Action as ActionShape1
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebWebScrapeHTMLParams\Pdf as PdfShape2
 * @phpstan-import-type ActionShape from \ContextDev\Web\WebWebScrapeImagesParams\Action as ActionShape2
 * @phpstan-import-type EnrichmentShape from \ContextDev\Web\WebWebScrapeImagesParams\Enrichment
 * @phpstan-import-type ActionShape from \ContextDev\Web\WebWebScrapeMdParams\Action as ActionShape3
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
     *   domain: string, numCompetitors?: int, tags?: list<string>, timeoutMs?: int
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
     *   directURL?: string,
     *   domain?: string,
     *   maxAgeMs?: int|null,
     *   tags?: list<string>,
     *   timeoutMs?: int,
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
     *   colorScheme?: ColorScheme|value-of<ColorScheme>,
     *   directURL?: string,
     *   domain?: string,
     *   maxAgeMs?: int|null,
     *   tags?: list<string>,
     *   timeoutMs?: int,
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
     *   clearPopups?: bool,
     *   colorScheme?: WebScreenshotParams\ColorScheme|value-of<WebScreenshotParams\ColorScheme>,
     *   country?: value-of<Country>,
     *   directURL?: string,
     *   domain?: string,
     *   fullScreenshot?: FullScreenshot|value-of<FullScreenshot>,
     *   handleCookiePopup?: bool,
     *   maxAgeMs?: int|null,
     *   page?: Page|value-of<Page>,
     *   scrollOffset?: int|null,
     *   tags?: list<string>,
     *   timeoutMs?: int,
     *   viewport?: Viewport|ViewportShape,
     *   waitForMs?: int|null,
     *   zdr?: Zdr|value-of<Zdr>,
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
     *   country?: value-of<WebSearchParams\Country>,
     *   excludeDomains?: list<string>,
     *   freshness?: Freshness|value-of<Freshness>,
     *   includeDomains?: list<string>,
     *   markdownOptions?: MarkdownOptions|MarkdownOptionsShape,
     *   numResults?: int,
     *   queryFanout?: bool,
     *   tags?: list<string>,
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
     *   timeoutMs?: int,
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
     * Scrapes the given URL and returns the raw HTML content of the page. The base request costs 1 credit; requests with browser actions cost 2 credits.
     *
     * @param array{
     *   url: string,
     *   actions?: list<ActionShape1>|null,
     *   country?: value-of<WebWebScrapeHTMLParams\Country>,
     *   excludeSelectors?: list<string>|null,
     *   headers?: array<string,string>,
     *   includeFrames?: bool,
     *   includeSelectors?: list<string>|null,
     *   maxAgeMs?: int|null,
     *   pdf?: WebWebScrapeHTMLParams\Pdf|PdfShape2,
     *   settleAnimations?: bool,
     *   tags?: list<string>,
     *   timeoutMs?: int,
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
            query: Util::array_transform_keys($parsed, ['timeoutMs' => 'timeoutMS']),
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
     *   dedupe?: bool,
     *   enrichment?: Enrichment|EnrichmentShape|null,
     *   headers?: array<string,string>,
     *   maxAgeMs?: int|null,
     *   tags?: list<string>,
     *   timeoutMs?: int,
     *   waitForMs?: int|null,
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
     * | 200 | Yes — 1 credit, or 2 credits with actions | Successful scrape, including a zero-length result when includeSelectors matched nothing |
     * | 400 | No | Invalid input, skipped PDF, or the page could not be scraped. error_code WEBSITE_BLOCKED specifically means the site answered with an anti-bot challenge, CAPTCHA wall, or login shell instead of the page (even when the site returned HTTP 200) — retrying later or from another country sometimes succeeds |
     * | 401 / 403 | No | Invalid/disabled key, insufficient permissions, or credits exhausted; inspect error_code |
     * | 404 | No | Target page returned or fingerprinted as not found |
     * | 408 | No | Request timed out |
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
     *   timeoutMs?: int,
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
            query: Util::array_transform_keys($parsed, ['timeoutMs' => 'timeoutMS']),
            options: $options,
            convert: WebWebScrapeMdResponse::class,
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
     *   timeoutMs?: int,
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
                ['sitemapURL' => 'sitemapUrl', 'timeoutMs' => 'timeoutMS']
            ),
            options: $options,
            convert: WebWebScrapeSitemapResponse::class,
        );
    }
}
