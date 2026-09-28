<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\WebContract;
use ContextDev\Web\WebAnswersParams\Mode;
use ContextDev\Web\WebAnswersParams\TimeoutOpts;
use ContextDev\Web\WebAnswersParams\Zdr;
use ContextDev\Web\WebAnswersResponse;
use ContextDev\Web\WebExtractCompetitorsResponse;
use ContextDev\Web\WebExtractStyleguideParams\ColorScheme;
use ContextDev\Web\WebExtractStyleguideResponse;
use ContextDev\Web\WebMapURLsResponse;
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
use ContextDev\Web\WebScreenshotParams\Country;
use ContextDev\Web\WebScreenshotParams\FullScreenshot;
use ContextDev\Web\WebScreenshotParams\Page;
use ContextDev\Web\WebScreenshotParams\Viewport;
use ContextDev\Web\WebScreenshotResponse;
use ContextDev\Web\WebSearchParams\Freshness;
use ContextDev\Web\WebSearchParams\HighlightsOptions;
use ContextDev\Web\WebSearchParams\MarkdownOptions;
use ContextDev\Web\WebSearchResponse;
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
 * @phpstan-import-type HighlightsOptionsShape from \ContextDev\Web\WebSearchParams\HighlightsOptions
 * @phpstan-import-type MarkdownOptionsShape from \ContextDev\Web\WebSearchParams\MarkdownOptions
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebSearchParams\TimeoutOpts as TimeoutOptsShape6
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebWebCrawlMdParams\Pdf
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebWebCrawlMdParams\TimeoutOpts as TimeoutOptsShape7
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class WebService implements WebContract
{
    /**
     * @api
     */
    public WebRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new WebRawService($client);
    }

    /**
     * @api
     *
     * Research the web and return a sourced answer in your JSON shape. Choose `fast` for a short task or `ultra` for deeper research.
     *
     * @param string $task Research task. The agent selects company/profile lookups, web searches, or page reads. Include domains or URLs to focus the research.
     * @param array<string,mixed> $jsonFormat Example answer object, not JSON Schema. Up to 8 levels, 500 values, and 16000 characters; unknowns may be null.
     * @param Mode|value-of<Mode> $mode `fast` prioritizes speed, with extra verification for people and companies; `ultra` supports deeper research (default)
     * @param list<string> $tags labels for filtering usage in the dashboard
     * @param TimeoutOpts|TimeoutOptsShape $timeoutOpts request deadline and what to return when it passes
     * @param Zdr|value-of<Zdr> $zdr `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function answers(
        string $task,
        ?array $jsonFormat = null,
        Mode|string|null $mode = null,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
        Zdr|string|null $zdr = null,
        RequestOptions|array|null $requestOptions = null,
    ): WebAnswersResponse {
        $params = Util::removeNulls(
            [
                'task' => $task,
                'jsonFormat' => $jsonFormat,
                'mode' => $mode,
                'tags' => $tags,
                'timeoutOpts' => $timeoutOpts,
                'zdr' => $zdr,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->answers(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Analyze a company's landing page and web search evidence to return direct competitors for the same product or market.
     *
     * @param string $domain Company domain to analyze, such as `stripe.com`. Full http(s) URLs are accepted and normalized to their domain.
     * @param int $numCompetitors Exact number of direct competitors to return. Defaults to 5.
     * @param list<string> $tags Comma-separated labels for filtering usage, e.g. `production,team-alpha`.
     * @param \ContextDev\Web\WebExtractCompetitorsParams\TimeoutOpts|TimeoutOptsShape1 $timeoutOpts request deadline and what to return when it passes
     * @param \ContextDev\Web\WebExtractCompetitorsParams\Zdr|value-of<\ContextDev\Web\WebExtractCompetitorsParams\Zdr> $zdr `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function extractCompetitors(
        string $domain,
        int $numCompetitors = 5,
        ?array $tags = null,
        \ContextDev\Web\WebExtractCompetitorsParams\TimeoutOpts|array|null $timeoutOpts = null,
        \ContextDev\Web\WebExtractCompetitorsParams\Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): WebExtractCompetitorsResponse {
        $params = Util::removeNulls(
            [
                'domain' => $domain,
                'numCompetitors' => $numCompetitors,
                'tags' => $tags,
                'timeoutOpts' => $timeoutOpts,
                'zdr' => $zdr,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->extractCompetitors(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Extract colors, typography, spacing, and component styles from a website.
     *
     * @param ColorScheme|value-of<ColorScheme> $colorScheme Optional browser color scheme to emulate for websites that respond to prefers-color-scheme. This value is part of the styleguide cache key.
     * @param string $directURL Exact URL to inspect. Provide either `domain` or `directUrl`, not both.
     * @param string $domain Domain name to extract styleguide from (e.g., 'example.com', 'google.com'). The domain will be automatically normalized and validated. You must provide either 'domain' or 'directUrl', but not both.
     * @param int|null $maxAgeMs Maximum age of cached brand data in ms. Defaults to 3 months; clamped to 0–1 year. `0` refreshes.
     * @param list<string> $tags Comma-separated labels for filtering usage, e.g. `production,team-alpha`.
     * @param \ContextDev\Web\WebExtractStyleguideParams\TimeoutOpts|TimeoutOptsShape2 $timeoutOpts request deadline and what to return when it passes
     * @param \ContextDev\Web\WebExtractStyleguideParams\Zdr|value-of<\ContextDev\Web\WebExtractStyleguideParams\Zdr> $zdr `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function extractStyleguide(
        ColorScheme|string|null $colorScheme = null,
        ?string $directURL = null,
        ?string $domain = null,
        ?int $maxAgeMs = 7776000000,
        ?array $tags = null,
        \ContextDev\Web\WebExtractStyleguideParams\TimeoutOpts|array|null $timeoutOpts = null,
        \ContextDev\Web\WebExtractStyleguideParams\Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): WebExtractStyleguideResponse {
        $params = Util::removeNulls(
            [
                'colorScheme' => $colorScheme,
                'directURL' => $directURL,
                'domain' => $domain,
                'maxAgeMs' => $maxAgeMs,
                'tags' => $tags,
                'timeoutOpts' => $timeoutOpts,
                'zdr' => $zdr,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->extractStyleguide(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Discover a site's URLs, with page titles, descriptions, keywords, and language when available. Metadata can be missing on newly discovered URLs.
     *
     * @param string $domain Domain to map, e.g. `stripe.com`.
     * @param array<string,string> $headers HTTP headers for the target origin. Non-empty headers bypass caching.
     * @param bool $includeSubdomains include URLs on subdomains
     * @param int $maxLinks maximum number of URLs to return
     * @param string $search filter URLs by a topic or phrase, most relevant first
     * @param string $sitemapURL Fetch this sitemap instead of discovering sitemaps. Must belong to the domain or a subdomain.
     * @param list<string> $tags Comma-separated labels for filtering usage, e.g. `production,team-alpha`.
     * @param \ContextDev\Web\WebMapURLsParams\TimeoutOpts|TimeoutOptsShape3 $timeoutOpts request deadline and what to return when it passes
     * @param string $urlRegex Optional RE2-compatible regex pattern. Only URLs matching this pattern are returned and counted against maxLinks.
     * @param \ContextDev\Web\WebMapURLsParams\Zdr|value-of<\ContextDev\Web\WebMapURLsParams\Zdr> $zdr `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function mapUrls(
        string $domain,
        ?array $headers = null,
        bool $includeSubdomains = false,
        int $maxLinks = 10000,
        ?string $search = null,
        ?string $sitemapURL = null,
        ?array $tags = null,
        \ContextDev\Web\WebMapURLsParams\TimeoutOpts|array|null $timeoutOpts = null,
        ?string $urlRegex = null,
        \ContextDev\Web\WebMapURLsParams\Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): WebMapURLsResponse {
        $params = Util::removeNulls(
            [
                'domain' => $domain,
                'headers' => $headers,
                'includeSubdomains' => $includeSubdomains,
                'maxLinks' => $maxLinks,
                'search' => $search,
                'sitemapURL' => $sitemapURL,
                'tags' => $tags,
                'timeoutOpts' => $timeoutOpts,
                'urlRegex' => $urlRegex,
                'zdr' => $zdr,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->mapUrls(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Scrape anything from a URL on the internet. Returns the outputs you enable in formats. Handles PDFs, DOCX, PPT, XLSX, and 40 other file formats.
     *
     * @param Formats|FormatsShape $formats Outputs to return. Set at least one to `true`.
     * @param string $url public HTTP or HTTPS URL to scrape
     * @param HighlightsParams|HighlightsParamsShape $highlightsParams Required when `formats.highlights` is `true`.
     * @param ImageParams|ImageParamsShape $imageParams Image options. Requires formats.images: true.
     * @param JsonParams|JsonParamsShape $jsonParams Required when formats.json is true.
     * @param MarkdownParams|MarkdownParamsShape $markdownParams Markdown options. Requires `formats.markdown`.
     * @param int $maxAgeMs Maximum age of a cached output, in milliseconds. `0` fetches fresh. Defaults to 3 days (259200000 ms). Maximum: 1 year (31536000000 ms).
     * @param ParseParams|ParseParamsShape $parseParams Required when formats.parse is true.
     * @param ProductParams|ProductParamsShape $productParams Product options. Requires formats.product: true.
     * @param ScreenshotParams|ScreenshotParamsShape $screenshotParams Screenshot options. Requires formats.screenshot: true.
     * @param SharedParams|SharedParamsShape $sharedParams browser and content settings shared by all outputs
     * @param list<string> $tags Labels for tracking request usage. Not retained when zdr is enabled.
     * @param \ContextDev\Web\WebScrapeParams\TimeoutOpts|TimeoutOptsShape4 $timeoutOpts Deadline for the whole request. Defaults to 60000 ms with `fail`. Fixed waits must end before it.
     * @param \ContextDev\Web\WebScrapeParams\Zdr|value-of<\ContextDev\Web\WebScrapeParams\Zdr> $zdr `enabled` turns on zero data retention. Your organization must have ZDR enabled.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function scrape(
        Formats|array $formats,
        string $url,
        HighlightsParams|array|null $highlightsParams = null,
        ImageParams|array|null $imageParams = null,
        JsonParams|array|null $jsonParams = null,
        MarkdownParams|array|null $markdownParams = null,
        int $maxAgeMs = 259200000,
        ParseParams|array|null $parseParams = null,
        ProductParams|array|null $productParams = null,
        ScreenshotParams|array|null $screenshotParams = null,
        SharedParams|array|null $sharedParams = null,
        ?array $tags = null,
        \ContextDev\Web\WebScrapeParams\TimeoutOpts|array $timeoutOpts = [
            'milliseconds' => 60000, 'behavior' => 'fail',
        ],
        \ContextDev\Web\WebScrapeParams\Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): WebScrapeResponse {
        $params = Util::removeNulls(
            [
                'formats' => $formats,
                'url' => $url,
                'highlightsParams' => $highlightsParams,
                'imageParams' => $imageParams,
                'jsonParams' => $jsonParams,
                'markdownParams' => $markdownParams,
                'maxAgeMs' => $maxAgeMs,
                'parseParams' => $parseParams,
                'productParams' => $productParams,
                'screenshotParams' => $screenshotParams,
                'sharedParams' => $sharedParams,
                'tags' => $tags,
                'timeoutOpts' => $timeoutOpts,
                'zdr' => $zdr,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->scrape(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Capture a screenshot of a website.
     *
     * @param bool $clearPopups Optional parameter for comprehensive popup cleanup. If 'true', the browser dismisses detected cookie/consent UI and clears other detected obstructive popups and overlays before capture. If 'false' or not provided, this parameter requests no cleanup; handleCookiePopup can still request cookie/consent handling independently.
     * @param \ContextDev\Web\WebScreenshotParams\ColorScheme|value-of<\ContextDev\Web\WebScreenshotParams\ColorScheme> $colorScheme Optional parameter to choose the site's visual theme in the screenshot. Use 'light' or 'dark' when the site offers both appearances.
     * @param Country|value-of<Country> $country fetch from this country (ISO 3166-1 alpha-2)
     * @param string $directURL A specific URL to screenshot directly, bypassing domain resolution (e.g., 'https://example.com/pricing'). When provided, the screenshot is taken of this exact URL. You must provide either 'domain' or 'directUrl', but not both.
     * @param string $domain Domain name to take screenshot of (e.g., 'example.com', 'google.com'). The domain will be automatically normalized and validated. You must provide either 'domain' or 'directUrl', but not both.
     * @param FullScreenshot|value-of<FullScreenshot> $fullScreenshot Optional parameter to determine screenshot type. If 'true', takes a full page screenshot capturing all content. If 'false' or not provided, takes a viewport screenshot (standard browser view).
     * @param bool $handleCookiePopup Optional parameter to control cookie/consent popup handling. If 'true', we dismiss cookie banner before capture. If 'false' or not provided, captures the page without that step.
     * @param array<string,string> $headers Optional outbound HTTP headers, using the same JSON object or deep-object query format as other scrape endpoints (for example headers[Authorization]=Bearer token). Headers are scoped to the target origin during capture. For domain/page requests, discovery receives no custom headers and only pages on the resolved origin are eligible. Non-empty headers bypass screenshot caching and return an in-memory data URL; no screenshot is uploaded. Empty objects behave like omitted headers.
     * @param int|null $maxAgeMs Return a cached screenshot if a prior screenshot for the same parameters exists and is younger than this many milliseconds. Defaults to 1 day (86400000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always capture fresh.
     * @param Page|value-of<Page> $page Optional parameter to specify which page type to screenshot. If provided, the system will scrape the domain's links and use heuristics to find the most appropriate URL for the specified page type (30 supported languages). If not provided, screenshots the main domain landing page. Only applicable when using 'domain', not 'directUrl'.
     * @param int|null $scrollOffset Optional vertical scroll offset in pixels for capturing a long page in viewport-sized chunks. When provided, the full page is captured once and the returned image is the viewport-sized slice that begins at this Y offset (e.g. request scrollOffset=0, then 1080, then 2160 to walk a 1920x1080 landing page top to bottom). The final slice may be shorter than the viewport height. Takes precedence over fullScreenshot. Max: 100000.
     * @param list<string> $tags Comma-separated labels for filtering usage, e.g. `production,team-alpha`.
     * @param \ContextDev\Web\WebScreenshotParams\TimeoutOpts|TimeoutOptsShape5 $timeoutOpts request deadline and what to return when it passes
     * @param Viewport|ViewportShape $viewport Optional browser viewport dimensions for the screenshot. Defaults to 1920x1080.
     * @param int|null $waitForMs Optional browser wait time in milliseconds after initial page load before taking the screenshot. Min: 0. Max: 30000 (30 seconds). Defaults to 3000 ms when omitted. When combined with timeoutOpts, timeoutOpts.milliseconds must be at least waitForMs + 10000 ms; a shorter deadline is rejected with 400 TIMEOUT_TOO_SHORT_FOR_WAIT.
     * @param \ContextDev\Web\WebScreenshotParams\Zdr|value-of<\ContextDev\Web\WebScreenshotParams\Zdr> $zdr `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function screenshot(
        bool $clearPopups = false,
        \ContextDev\Web\WebScreenshotParams\ColorScheme|string|null $colorScheme = null,
        Country|string|null $country = null,
        ?string $directURL = null,
        ?string $domain = null,
        FullScreenshot|string|null $fullScreenshot = null,
        bool $handleCookiePopup = false,
        ?array $headers = null,
        ?int $maxAgeMs = 86400000,
        Page|string|null $page = null,
        ?int $scrollOffset = null,
        ?array $tags = null,
        \ContextDev\Web\WebScreenshotParams\TimeoutOpts|array|null $timeoutOpts = null,
        Viewport|array $viewport = ['width' => 1920, 'height' => 1080],
        ?int $waitForMs = 3000,
        \ContextDev\Web\WebScreenshotParams\Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): WebScreenshotResponse {
        $params = Util::removeNulls(
            [
                'clearPopups' => $clearPopups,
                'colorScheme' => $colorScheme,
                'country' => $country,
                'directURL' => $directURL,
                'domain' => $domain,
                'fullScreenshot' => $fullScreenshot,
                'handleCookiePopup' => $handleCookiePopup,
                'headers' => $headers,
                'maxAgeMs' => $maxAgeMs,
                'page' => $page,
                'scrollOffset' => $scrollOffset,
                'tags' => $tags,
                'timeoutOpts' => $timeoutOpts,
                'viewport' => $viewport,
                'waitForMs' => $waitForMs,
                'zdr' => $zdr,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->screenshot(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Search the web and optionally return page content or relevant passages with each result.
     *
     * @param string $query Search query. Accepts natural language as well as Google-style search operators such as `site:`, `-site:`, `inurl:`, `intitle:`, quoted phrases, and `OR`.
     * @param \ContextDev\Web\WebSearchParams\Country|value-of<\ContextDev\Web\WebSearchParams\Country> $country Two-letter ISO 3166-1 alpha-2 country code to localize results to a specific country (maps to Google's `gl` parameter). Example: "us", "gb", "de".
     * @param list<string> $excludeDomains Blocklist — drop results from these domains. Example: ["pinterest.com", "reddit.com"].
     * @param Freshness|value-of<Freshness> $freshness restrict results to content published within this window
     * @param HighlightsOptions|HighlightsOptionsShape $highlightsOptions Passages from each result page that are relevant to the query. Pages are read with the `markdownOptions` settings.
     * @param list<string> $includeDomains Allowlist — only return results from these domains. Example: ["arxiv.org", "github.com"].
     * @param MarkdownOptions|MarkdownOptionsShape $markdownOptions Inline Markdown scraping for each result. Set `enabled: true` to activate.
     * @param int $numResults Number of results to request and return (10–100). Defaults to 10.
     * @param bool $queryFanout currently has no effect
     * @param list<string> $tags labels for filtering usage in the dashboard
     * @param \ContextDev\Web\WebSearchParams\TimeoutOpts|TimeoutOptsShape6 $timeoutOpts request deadline and what to return when it passes
     * @param \ContextDev\Web\WebSearchParams\Zdr|value-of<\ContextDev\Web\WebSearchParams\Zdr> $zdr `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function search(
        string $query,
        \ContextDev\Web\WebSearchParams\Country|string|null $country = null,
        ?array $excludeDomains = null,
        Freshness|string|null $freshness = null,
        HighlightsOptions|array|null $highlightsOptions = null,
        ?array $includeDomains = null,
        MarkdownOptions|array|null $markdownOptions = null,
        int $numResults = 10,
        ?bool $queryFanout = null,
        ?array $tags = null,
        \ContextDev\Web\WebSearchParams\TimeoutOpts|array|null $timeoutOpts = null,
        \ContextDev\Web\WebSearchParams\Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): WebSearchResponse {
        $params = Util::removeNulls(
            [
                'query' => $query,
                'country' => $country,
                'excludeDomains' => $excludeDomains,
                'freshness' => $freshness,
                'highlightsOptions' => $highlightsOptions,
                'includeDomains' => $includeDomains,
                'markdownOptions' => $markdownOptions,
                'numResults' => $numResults,
                'queryFanout' => $queryFanout,
                'tags' => $tags,
                'timeoutOpts' => $timeoutOpts,
                'zdr' => $zdr,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->search(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Crawl a website and return page content as Markdown. Use a batch for crawls beyond 500 pages.
     *
     * @param string $url start URL, including `http://` or `https://`
     * @param \ContextDev\Web\WebWebCrawlMdParams\Country|value-of<\ContextDev\Web\WebWebCrawlMdParams\Country> $country fetch from this country (ISO 3166-1 alpha-2)
     * @param list<string> $excludeSelectors Remove matching elements after inclusions. Exclusions take precedence.
     * @param bool $followSubdomains When true, follow links on subdomains of the starting URL's domain (e.g. docs.example.com when starting from example.com). www and apex are always treated as equivalent.
     * @param bool $includeFrames when true, the contents of iframes are rendered to Markdown for each crawled page
     * @param bool $includeImages Include image references in the Markdown output
     * @param bool $includeLinks Preserve hyperlinks in the Markdown output
     * @param list<string> $includeSelectors keep matching HTML subtrees before converting each page to Markdown
     * @param int $maxAgeMs Maximum cache age in milliseconds. Defaults to 1 day; `0` fetches fresh.
     * @param int $maxDepth Maximum link depth from the starting URL (0 = only the starting page)
     * @param int $maxPages maximum pages to crawl
     * @param Pdf|PdfShape $pdf PDF handling. `start`/`end` limit parsing to an inclusive, 1-based page range.
     * @param bool $settleAnimations wait briefly for CSS animations and transitions to settle before reading each page
     * @param bool $shortenBase64Images Truncate base64-encoded image data in the Markdown output
     * @param int $stopAfterMs Soft crawl deadline in milliseconds. Returns pages collected before the next deadline check.
     * @param list<string> $tags labels for filtering usage in the dashboard
     * @param \ContextDev\Web\WebWebCrawlMdParams\TimeoutOpts|TimeoutOptsShape7 $timeoutOpts request deadline and what to return when it passes
     * @param string $urlRegex Regex pattern. Only URLs matching this pattern will be followed and scraped. An automatic prefix scope in the form ^<starting URL> follows a redirect of the starting page.
     * @param bool $useMainContentOnly Extract only the main content, stripping headers, footers, sidebars, and navigation
     * @param int $waitForMs Browser wait time in milliseconds after initial page load for each crawled page. Defaults to 3500 (3.5 seconds). Min: 0. Max: 30000 (30 seconds).
     * @param \ContextDev\Web\WebWebCrawlMdParams\Zdr|value-of<\ContextDev\Web\WebWebCrawlMdParams\Zdr> $zdr `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function webCrawlMd(
        string $url,
        \ContextDev\Web\WebWebCrawlMdParams\Country|string|null $country = null,
        ?array $excludeSelectors = null,
        bool $followSubdomains = false,
        bool $includeFrames = false,
        bool $includeImages = false,
        bool $includeLinks = true,
        ?array $includeSelectors = null,
        int $maxAgeMs = 86400000,
        ?int $maxDepth = null,
        int $maxPages = 100,
        Pdf|array $pdf = ['shouldParse' => true, 'ocr' => false],
        bool $settleAnimations = false,
        bool $shortenBase64Images = true,
        int $stopAfterMs = 80000,
        ?array $tags = null,
        \ContextDev\Web\WebWebCrawlMdParams\TimeoutOpts|array|null $timeoutOpts = null,
        ?string $urlRegex = null,
        bool $useMainContentOnly = false,
        int $waitForMs = 3500,
        \ContextDev\Web\WebWebCrawlMdParams\Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): WebWebCrawlMdResponse {
        $params = Util::removeNulls(
            [
                'url' => $url,
                'country' => $country,
                'excludeSelectors' => $excludeSelectors,
                'followSubdomains' => $followSubdomains,
                'includeFrames' => $includeFrames,
                'includeImages' => $includeImages,
                'includeLinks' => $includeLinks,
                'includeSelectors' => $includeSelectors,
                'maxAgeMs' => $maxAgeMs,
                'maxDepth' => $maxDepth,
                'maxPages' => $maxPages,
                'pdf' => $pdf,
                'settleAnimations' => $settleAnimations,
                'shortenBase64Images' => $shortenBase64Images,
                'stopAfterMs' => $stopAfterMs,
                'tags' => $tags,
                'timeoutOpts' => $timeoutOpts,
                'urlRegex' => $urlRegex,
                'useMainContentOnly' => $useMainContentOnly,
                'waitForMs' => $waitForMs,
                'zdr' => $zdr,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->webCrawlMd(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
