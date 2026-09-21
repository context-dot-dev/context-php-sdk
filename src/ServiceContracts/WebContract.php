<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;
use ContextDev\Web\WebAnswersParams\Mode;
use ContextDev\Web\WebAnswersParams\TimeoutOpts;
use ContextDev\Web\WebAnswersParams\Zdr;
use ContextDev\Web\WebAnswersResponse;
use ContextDev\Web\WebExtractCompetitorsResponse;
use ContextDev\Web\WebExtractFontsResponse;
use ContextDev\Web\WebExtractParams\Pdf;
use ContextDev\Web\WebExtractResponse;
use ContextDev\Web\WebExtractStyleguideParams\ColorScheme;
use ContextDev\Web\WebExtractStyleguideResponse;
use ContextDev\Web\WebScrapeParams\Formats;
use ContextDev\Web\WebScrapeParams\ImageParams;
use ContextDev\Web\WebScrapeParams\MarkdownParams;
use ContextDev\Web\WebScrapeParams\ParseParams;
use ContextDev\Web\WebScrapeParams\ScreenshotParams;
use ContextDev\Web\WebScrapeParams\SharedParams;
use ContextDev\Web\WebScrapeResponse;
use ContextDev\Web\WebScreenshotParams\Country;
use ContextDev\Web\WebScreenshotParams\FullScreenshot;
use ContextDev\Web\WebScreenshotParams\Page;
use ContextDev\Web\WebScreenshotParams\Viewport;
use ContextDev\Web\WebScreenshotResponse;
use ContextDev\Web\WebSearchParams\Freshness;
use ContextDev\Web\WebSearchParams\MarkdownOptions;
use ContextDev\Web\WebSearchResponse;
use ContextDev\Web\WebWebCrawlMdResponse;
use ContextDev\Web\WebWebScrapeBytesResponse;
use ContextDev\Web\WebWebScrapeHTMLResponse;
use ContextDev\Web\WebWebScrapeImagesParams\Enrichment;
use ContextDev\Web\WebWebScrapeImagesResponse;
use ContextDev\Web\WebWebScrapeMdResponse;
use ContextDev\Web\WebWebScrapeScreenshotResponse;
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
interface WebContract
{
    /**
     * @api
     *
     * @param string $task What to research and answer, in plain language. Naming a domain in the task (for example "pricing on context.dev") makes the agent read that site before it searches.
     * @param array<string,mixed> $jsonFormat An example object with placeholder values (for example {"pricing_page_url": "", "plans": [{"name": "", "price": 0}]}). Object keys and value types are preserved; unknown values may be null. Empty arrays accept any JSON items. Defaults to {"result": ""}. Maximum 8 levels, 500 values, and 16000 characters.
     * @param Mode|value-of<Mode> $mode Research level: fast uses a smaller model and research budget for 10 credits; ultra uses deeper reasoning and research for 100 credits. Defaults to ultra. Only successful requests consume credits.
     * @param list<string> $tags Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
     * @param TimeoutOpts|TimeoutOptsShape $timeoutOpts Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     * @param Zdr|value-of<Zdr> $zdr Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Asset uploads are skipped, so hosted image URLs are omitted. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
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
    ): WebAnswersResponse;

    /**
     * @api
     *
     * @param array<string,mixed> $schema JSON Schema for the returned data object. Image fields such as `image_urls` or `product_photos` automatically make page image references available to extraction, so product data and photos can be returned in one call. TypeScript Zod users can pass a JSON Schema generated from a Zod object; Python users can pass the equivalent JSON Schema object.
     * @param string $url The starting website URL to crawl and extract from. Must include http:// or https://.
     * @param list<ActionShape> $actions Optional browser actions executed in order on the requested page after it loads, before links are discovered or additional pages are crawled. Requires a paid plan. When actions are provided and stopAfterMs is omitted, the crawl budget defaults to 110000 ms.
     * @param bool $factCheck When true, every returned value must be grounded in facts stated on the page; fields that cannot be supported by the page are returned as null/empty. When false (default), the model may make reasonable inferences and derivations from the page content (e.g. ideal customer, competitor analysis, recommendations) while keeping verifiable specifics (names, quotes, URLs, dates, metrics) faithful to the source.
     * @param bool $followSubdomains when true, follow links on subdomains of the starting URL's domain
     * @param bool $includeFrames when true, iframe contents are included in Markdown before extraction
     * @param string $instructions optional extraction guidance, such as which facts to prioritize or how to interpret fields in the schema
     * @param int $maxAgeMs Return cached scrape results if a prior scrape for the same parameters is younger than this many milliseconds. Defaults to 7 days (604800000 ms).
     * @param int $maxDepth Optional maximum link depth from the starting URL (0 = only the starting page). If omitted, there is no crawl depth limit.
     * @param int $maxPages Maximum number of pages to analyze for extraction. Hard cap: 50. Defaults to 5.
     * @param Pdf|PdfShape $pdf
     * @param bool $settleAnimations When true, waits briefly for CSS and transition animations to settle before extracting each crawled page. Defaults to false. This adds a bit of latency in exchange for more stable output on animated pages.
     * @param int $stopAfterMs Soft time budget for the crawl in milliseconds. Min: 10000 (10s). Max: 110000 (110s). Defaults to 80000 (80s), or 110000 (110s) when browser actions are provided.
     * @param list<string> $tags Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
     * @param \ContextDev\Web\WebExtractParams\TimeoutOpts|TimeoutOptsShape1 $timeoutOpts Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     * @param int $waitForMs optional browser wait time in milliseconds after initial page load for each crawled page
     * @param \ContextDev\Web\WebExtractParams\Zdr|value-of<\ContextDev\Web\WebExtractParams\Zdr> $zdr Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Asset uploads are skipped, so hosted image URLs are omitted. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function extract(
        array $schema,
        string $url,
        ?array $actions = null,
        bool $factCheck = false,
        bool $followSubdomains = false,
        bool $includeFrames = false,
        ?string $instructions = null,
        int $maxAgeMs = 604800000,
        ?int $maxDepth = null,
        int $maxPages = 5,
        Pdf|array $pdf = ['shouldParse' => true],
        bool $settleAnimations = false,
        int $stopAfterMs = 80000,
        ?array $tags = null,
        \ContextDev\Web\WebExtractParams\TimeoutOpts|array|null $timeoutOpts = null,
        ?int $waitForMs = null,
        \ContextDev\Web\WebExtractParams\Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): WebExtractResponse;

    /**
     * @api
     *
     * @param string $domain Company domain to analyze, such as `stripe.com`. Full http(s) URLs are accepted and normalized to their domain.
     * @param int $numCompetitors Exact number of direct competitors to return. Defaults to 5.
     * @param list<string> $tags Comma-separated tags for tracking request usage. Up to 20 tags, each 1-50 characters.
     * @param \ContextDev\Web\WebExtractCompetitorsParams\TimeoutOpts|TimeoutOptsShape2 $timeoutOpts Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     * @param \ContextDev\Web\WebExtractCompetitorsParams\Zdr|value-of<\ContextDev\Web\WebExtractCompetitorsParams\Zdr> $zdr Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Asset uploads are skipped, so hosted image URLs are omitted. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
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
    ): WebExtractCompetitorsResponse;

    /**
     * @api
     *
     * @param string $directURL A specific URL to fetch fonts from directly, bypassing domain resolution (e.g., 'https://example.com/design-system'). When provided, fonts are extracted from this exact URL. You must provide either 'domain' or 'directUrl', but not both.
     * @param string $domain Domain name to extract fonts from (e.g., 'example.com', 'google.com'). The domain will be automatically normalized and validated. You must provide either 'domain' or 'directUrl', but not both.
     * @param int|null $maxAgeMs Maximum age in milliseconds for cached brand data before the API performs a hard refresh. Defaults to 3 months (7776000000 ms). Set to 0 to always perform a hard refresh. Negative values are clamped to 0; values above 1 year (31536000000 ms) are clamped to 1 year.
     * @param list<string> $tags Comma-separated tags for tracking request usage. Up to 20 tags, each 1-50 characters.
     * @param \ContextDev\Web\WebExtractFontsParams\TimeoutOpts|TimeoutOptsShape3 $timeoutOpts Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function extractFonts(
        ?string $directURL = null,
        ?string $domain = null,
        ?int $maxAgeMs = 7776000000,
        ?array $tags = null,
        \ContextDev\Web\WebExtractFontsParams\TimeoutOpts|array|null $timeoutOpts = null,
        RequestOptions|array|null $requestOptions = null,
    ): WebExtractFontsResponse;

    /**
     * @api
     *
     * @param ColorScheme|value-of<ColorScheme> $colorScheme Optional browser color scheme to emulate for websites that respond to prefers-color-scheme. This value is part of the styleguide cache key.
     * @param string $directURL A specific URL to fetch the styleguide from directly, bypassing domain resolution (e.g., 'https://example.com/design-system'). When provided, the styleguide is extracted from this exact URL. You must provide either 'domain' or 'directUrl', but not both.
     * @param string $domain Domain name to extract styleguide from (e.g., 'example.com', 'google.com'). The domain will be automatically normalized and validated. You must provide either 'domain' or 'directUrl', but not both.
     * @param int|null $maxAgeMs Maximum age in milliseconds for cached brand data before the API performs a hard refresh. Defaults to 3 months (7776000000 ms). Set to 0 to always perform a hard refresh. Negative values are clamped to 0; values above 1 year (31536000000 ms) are clamped to 1 year.
     * @param list<string> $tags Comma-separated tags for tracking request usage. Up to 20 tags, each 1-50 characters.
     * @param \ContextDev\Web\WebExtractStyleguideParams\TimeoutOpts|TimeoutOptsShape4 $timeoutOpts Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     * @param \ContextDev\Web\WebExtractStyleguideParams\Zdr|value-of<\ContextDev\Web\WebExtractStyleguideParams\Zdr> $zdr Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Asset uploads are skipped, so hosted image URLs are omitted. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
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
    ): WebExtractStyleguideResponse;

    /**
     * @api
     *
     * @param Formats|FormatsShape $formats Outputs to return. Enable at least one; omitted formats are false.
     * @param string $url the URL to scrape
     * @param ImageParams|ImageParamsShape $imageParams Image options. Requires formats.images: true.
     * @param MarkdownParams|MarkdownParamsShape $markdownParams Markdown options. Requires formats.markdown: true.
     * @param int $maxAgeMs Maximum age for the entire capture, including bytes. Defaults to 1 day; 0 fetches fresh. Captures with hosted image files refresh after 23 hours.
     * @param ParseParams|ParseParamsShape $parseParams Required when formats.parse is true.
     * @param ScreenshotParams|ScreenshotParamsShape $screenshotParams Screenshot options. Requires formats.screenshot: true.
     * @param SharedParams|SharedParamsShape $sharedParams Shared browser and content settings. Content filters leave screenshots and original bytes unchanged.
     * @param list<string> $tags Labels for tracking request usage. Not retained when zdr is enabled.
     * @param int $timeoutMs total deadline, including navigation, actions, waiting, and all outputs
     * @param \ContextDev\Web\WebScrapeParams\Zdr|value-of<\ContextDev\Web\WebScrapeParams\Zdr> $zdr Zero data retention. Bypasses caches and uploads; excludes request/response content and tags from logs. Must be enabled for your organization.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function scrape(
        Formats|array $formats,
        string $url,
        ImageParams|array|null $imageParams = null,
        MarkdownParams|array|null $markdownParams = null,
        int $maxAgeMs = 86400000,
        ParseParams|array|null $parseParams = null,
        ScreenshotParams|array|null $screenshotParams = null,
        SharedParams|array|null $sharedParams = null,
        ?array $tags = null,
        int $timeoutMs = 60000,
        \ContextDev\Web\WebScrapeParams\Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): WebScrapeResponse;

    /**
     * @api
     *
     * @param bool $clearPopups Optional parameter for comprehensive popup cleanup. If 'true', the browser dismisses detected cookie/consent UI and clears other detected obstructive popups and overlays before capture. If 'false' or not provided, this parameter requests no cleanup; handleCookiePopup can still request cookie/consent handling independently.
     * @param \ContextDev\Web\WebScreenshotParams\ColorScheme|value-of<\ContextDev\Web\WebScreenshotParams\ColorScheme> $colorScheme Optional parameter to choose the site's visual theme in the screenshot. Use 'light' or 'dark' when the site offers both appearances.
     * @param Country|value-of<Country> $country fetch the target page through a residential proxy in this country (ISO 3166-1 alpha-2)
     * @param string $directURL A specific URL to screenshot directly, bypassing domain resolution (e.g., 'https://example.com/pricing'). When provided, the screenshot is taken of this exact URL. You must provide either 'domain' or 'directUrl', but not both.
     * @param string $domain Domain name to take screenshot of (e.g., 'example.com', 'google.com'). The domain will be automatically normalized and validated. You must provide either 'domain' or 'directUrl', but not both.
     * @param FullScreenshot|value-of<FullScreenshot> $fullScreenshot Optional parameter to determine screenshot type. If 'true', takes a full page screenshot capturing all content. If 'false' or not provided, takes a viewport screenshot (standard browser view).
     * @param bool $handleCookiePopup Optional parameter to control cookie/consent popup handling. If 'true', we dismiss cookie banner before capture. If 'false' or not provided, captures the page without that step.
     * @param array<string,string> $headers Optional outbound HTTP headers, using the same JSON object or deep-object query format as other scrape endpoints (for example headers[Authorization]=Bearer token). Headers are scoped to the target origin during capture. For domain/page requests, discovery receives no custom headers and only pages on the resolved origin are eligible. Non-empty headers bypass screenshot caching and return an in-memory data URL; no screenshot is uploaded. Empty objects behave like omitted headers.
     * @param int|null $maxAgeMs Return a cached screenshot if a prior screenshot for the same parameters exists and is younger than this many milliseconds. Defaults to 1 day (86400000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always capture fresh.
     * @param Page|value-of<Page> $page Optional parameter to specify which page type to screenshot. If provided, the system will scrape the domain's links and use heuristics to find the most appropriate URL for the specified page type (30 supported languages). If not provided, screenshots the main domain landing page. Only applicable when using 'domain', not 'directUrl'.
     * @param int|null $scrollOffset Optional vertical scroll offset in pixels for capturing a long page in viewport-sized chunks. When provided, the full page is captured once and the returned image is the viewport-sized slice that begins at this Y offset (e.g. request scrollOffset=0, then 1080, then 2160 to walk a 1920x1080 landing page top to bottom). The final slice may be shorter than the viewport height. Takes precedence over fullScreenshot. Max: 100000.
     * @param list<string> $tags Comma-separated tags for tracking request usage. Up to 20 tags, each 1-50 characters.
     * @param \ContextDev\Web\WebScreenshotParams\TimeoutOpts|TimeoutOptsShape5 $timeoutOpts Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     * @param Viewport|ViewportShape $viewport Optional browser viewport dimensions for the screenshot. Defaults to 1920x1080.
     * @param int|null $waitForMs Optional browser wait time in milliseconds after initial page load before taking the screenshot. Min: 0. Max: 30000 (30 seconds). Defaults to 3000 ms when omitted. When combined with timeoutOpts, timeoutOpts.milliseconds must be at least waitForMs + 10000 ms; a shorter deadline is rejected with 400 TIMEOUT_TOO_SHORT_FOR_WAIT.
     * @param \ContextDev\Web\WebScreenshotParams\Zdr|value-of<\ContextDev\Web\WebScreenshotParams\Zdr> $zdr Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Asset uploads are skipped, so hosted image URLs are omitted. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
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
    ): WebScreenshotResponse;

    /**
     * @api
     *
     * @param string $query Search query. Accepts natural language as well as Google-style search operators such as `site:`, `-site:`, `inurl:`, `intitle:`, quoted phrases, and `OR`.
     * @param \ContextDev\Web\WebSearchParams\Country|value-of<\ContextDev\Web\WebSearchParams\Country> $country Two-letter ISO 3166-1 alpha-2 country code to localize results to a specific country (maps to Google's `gl` parameter). Example: "us", "gb", "de".
     * @param list<string> $excludeDomains Blocklist — drop results from these domains. Example: ["pinterest.com", "reddit.com"].
     * @param Freshness|value-of<Freshness> $freshness restrict results to content published within this window
     * @param list<string> $includeDomains Allowlist — only return results from these domains. Example: ["arxiv.org", "github.com"].
     * @param MarkdownOptions|MarkdownOptionsShape $markdownOptions Inline Markdown scraping for each result. Set `enabled: true` to activate.
     * @param int $numResults Number of results to request and return (10–100). Defaults to 10.
     * @param bool $queryFanout expand the query into multiple parallel variants for broader recall
     * @param list<string> $tags Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
     * @param \ContextDev\Web\WebSearchParams\TimeoutOpts|TimeoutOptsShape6 $timeoutOpts Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     * @param \ContextDev\Web\WebSearchParams\Zdr|value-of<\ContextDev\Web\WebSearchParams\Zdr> $zdr Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Asset uploads are skipped, so hosted image URLs are omitted. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function search(
        string $query,
        \ContextDev\Web\WebSearchParams\Country|string|null $country = null,
        ?array $excludeDomains = null,
        Freshness|string|null $freshness = null,
        ?array $includeDomains = null,
        MarkdownOptions|array|null $markdownOptions = null,
        int $numResults = 10,
        ?bool $queryFanout = null,
        ?array $tags = null,
        \ContextDev\Web\WebSearchParams\TimeoutOpts|array|null $timeoutOpts = null,
        \ContextDev\Web\WebSearchParams\Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): WebSearchResponse;

    /**
     * @api
     *
     * @param string $url The starting URL for the crawl (must include http:// or https:// protocol)
     * @param \ContextDev\Web\WebWebCrawlMdParams\Country|value-of<\ContextDev\Web\WebWebCrawlMdParams\Country> $country fetch the target page through a residential proxy in this country (ISO 3166-1 alpha-2)
     * @param list<string> $excludeSelectors CSS selectors to remove before each crawled page is converted to Markdown. Applied after includeSelectors. Exclusion takes precedence: an element matching both is removed. Examples: "nav", "footer", ".ad-banner", "[aria-hidden=true]".
     * @param bool $followSubdomains When true, follow links on subdomains of the starting URL's domain (e.g. docs.example.com when starting from example.com). www and apex are always treated as equivalent.
     * @param bool $includeFrames when true, the contents of iframes are rendered to Markdown for each crawled page
     * @param bool $includeImages Include image references in the Markdown output
     * @param bool $includeLinks Preserve hyperlinks in the Markdown output
     * @param list<string> $includeSelectors CSS selectors. When provided, only matching HTML subtrees (and their descendants) are kept before each crawled page is converted to Markdown. When omitted, the entire document is kept. Examples: "article.main", "#content", "[role=main]".
     * @param int $maxAgeMs Return a cached result if a prior scrape for the same parameters exists and is younger than this many milliseconds. Defaults to 1 day (86400000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always scrape fresh.
     * @param int $maxDepth Maximum link depth from the starting URL (0 = only the starting page)
     * @param int $maxPages Maximum number of pages to crawl. Hard cap: 500.
     * @param \ContextDev\Web\WebWebCrawlMdParams\Pdf|PdfShape1 $pdf PDF parsing controls. Use start/end to limit text extraction and embedded-image detection/OCR to an inclusive 1-based page range.
     * @param bool $settleAnimations When true, waits briefly for CSS and transition animations to settle before extracting each crawled page. Defaults to false. This adds a bit of latency in exchange for more stable output on animated pages.
     * @param bool $shortenBase64Images Truncate base64-encoded image data in the Markdown output
     * @param int $stopAfterMs Soft time budget for the crawl in milliseconds. After each scrape, the crawler checks the elapsed time and, if exceeded, returns the pages collected so far instead of continuing. Min: 10000 (10s). Max: 110000 (110s). Default: 80000 (80s).
     * @param list<string> $tags Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
     * @param \ContextDev\Web\WebWebCrawlMdParams\TimeoutOpts|TimeoutOptsShape7 $timeoutOpts Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     * @param string $urlRegex Regex pattern. Only URLs matching this pattern will be followed and scraped. An automatic prefix scope in the form ^<starting URL> follows a redirect of the starting page.
     * @param bool $useMainContentOnly Extract only the main content, stripping headers, footers, sidebars, and navigation
     * @param int $waitForMs Browser wait time in milliseconds after initial page load for each crawled page. Defaults to 3500 (3.5 seconds). Min: 0. Max: 30000 (30 seconds).
     * @param \ContextDev\Web\WebWebCrawlMdParams\Zdr|value-of<\ContextDev\Web\WebWebCrawlMdParams\Zdr> $zdr Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
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
        \ContextDev\Web\WebWebCrawlMdParams\Pdf|array $pdf = [
            'shouldParse' => true, 'ocr' => false,
        ],
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
    ): WebWebCrawlMdResponse;

    /**
     * @api
     *
     * @param string $url full HTTP(S) URL of the resource to download, such as an image, PDF, or page
     * @param \ContextDev\Web\WebWebScrapeBytesParams\Country|value-of<\ContextDev\Web\WebWebScrapeBytesParams\Country> $country fetch the target page through a residential proxy in this country (ISO 3166-1 alpha-2)
     * @param array<string,string> $headers Optional outbound HTTP headers, such as Referer, Cookie, or Authorization. Send as a JSON object or deep-object query params such as headers[Referer]=https://example.com/. Host, Content-Length, and hop-by-hop transport headers are rejected. Authorization and cookies are removed when a redirect changes origin. Credential-bearing headers bypass cache reads and writes; other headers are included in the cache key.
     * @param int|null $maxAgeMs Return a cached result if a prior scrape for the same parameters exists and is younger than this many milliseconds. Defaults to 1 day (86400000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always scrape fresh.
     * @param list<string> $tags Comma-separated tags for tracking request usage. Up to 20 tags, each 1-50 characters.
     * @param \ContextDev\Web\WebWebScrapeBytesParams\TimeoutOpts|TimeoutOptsShape8 $timeoutOpts Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     * @param int|null $waitForMs Optional browser wait time after initial page load, in milliseconds (0–30000; 0 uses 500). When supplied, HTML is rendered with JavaScript and returned as UTF-8 bytes. Other resources keep their original bytes without a browser wait. Omit to download the original HTTP response. When combined with timeoutOpts, timeoutOpts.milliseconds must be at least waitForMs + 10000 ms; a shorter deadline is rejected with 400 TIMEOUT_TOO_SHORT_FOR_WAIT.
     * @param \ContextDev\Web\WebWebScrapeBytesParams\Zdr|value-of<\ContextDev\Web\WebWebScrapeBytesParams\Zdr> $zdr Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Asset uploads are skipped, so hosted image URLs are omitted. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function webScrapeBytes(
        string $url,
        \ContextDev\Web\WebWebScrapeBytesParams\Country|string|null $country = null,
        ?array $headers = null,
        ?int $maxAgeMs = 86400000,
        ?array $tags = null,
        \ContextDev\Web\WebWebScrapeBytesParams\TimeoutOpts|array|null $timeoutOpts = null,
        ?int $waitForMs = null,
        \ContextDev\Web\WebWebScrapeBytesParams\Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): WebWebScrapeBytesResponse;

    /**
     * @api
     *
     * @param string $url Full URL to scrape (must include http:// or https:// protocol)
     * @param list<ActionShape1>|null $actions Optional browser actions executed in array order after the page loads and before content is captured. Requires a paid plan. Send a JSON array in the query parameter. Maximum: 5 actions.
     * @param \ContextDev\Web\WebWebScrapeHTMLParams\Country|value-of<\ContextDev\Web\WebWebScrapeHTMLParams\Country> $country fetch the target page through a residential proxy in this country (ISO 3166-1 alpha-2)
     * @param list<string>|null $excludeSelectors CSS selectors to remove from the result. Applied after includeSelectors. Exclusion takes precedence: an element matching both is removed. Examples: "nav", "footer", ".ad-banner", "[aria-hidden=true]".
     * @param array<string,ExtractRuleShape> $extractRules Optional CSS extraction rules applied to the returned HTML after selector and main-content filtering. Use selector strings ("h1", "a@href") or objects with selector, type (item or list), and output (text, html, @attribute, or nested rules). Text whitespace is normalized; html includes the matched element; attributes are returned as written. Missing items are null and missing lists are empty. CSS only; XPath is not supported. Maximum: 100 fields across 5 levels. Send a JSON-encoded string in the extractRules query parameter.
     * @param array<string,string> $headers Optional outbound HTTP headers forwarded only to the target URL, sent as deep-object query params such as headers[X-Custom]=value. When provided, caching is bypassed: the result is neither read from nor written to cache.
     * @param bool $includeFrames when true, iframes are rendered inline into the returned HTML
     * @param list<string>|null $includeSelectors CSS selectors. When provided, only matching subtrees (and their descendants) are kept and everything else is dropped. When omitted, the entire document is kept. Examples: "article.main", "#content", "[role=main]".
     * @param int|null $maxAgeMs Return a cached result if a prior scrape for the same parameters exists and is younger than this many milliseconds. Defaults to 1 day (86400000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always scrape fresh.
     * @param \ContextDev\Web\WebWebScrapeHTMLParams\Pdf|PdfShape2 $pdf PDF parsing controls. Use start/end to limit text extraction and embedded-image detection/OCR to an inclusive 1-based page range.
     * @param bool $settleAnimations When true, waits briefly for CSS and transition animations to settle before extracting HTML. Defaults to false. This adds a bit of latency in exchange for more stable output on animated pages.
     * @param list<string> $tags Comma-separated tags for tracking request usage. Up to 20 tags, each 1-50 characters.
     * @param \ContextDev\Web\WebWebScrapeHTMLParams\TimeoutOpts|TimeoutOptsShape9 $timeoutOpts Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     * @param bool $useMainContentOnly when true, return only the page's main content in the HTML response, excluding headers, footers, sidebars, and navigation when detectable
     * @param int|null $waitForMs Optional browser wait time in milliseconds after initial page load. Min: 0. Max: 30000 (30 seconds). When combined with timeoutOpts, timeoutOpts.milliseconds must be at least waitForMs + 10000 ms; a shorter deadline is rejected with 400 TIMEOUT_TOO_SHORT_FOR_WAIT.
     * @param \ContextDev\Web\WebWebScrapeHTMLParams\Zdr|value-of<\ContextDev\Web\WebWebScrapeHTMLParams\Zdr> $zdr Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Asset uploads are skipped, so hosted image URLs are omitted. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function webScrapeHTML(
        string $url,
        ?array $actions = null,
        \ContextDev\Web\WebWebScrapeHTMLParams\Country|string|null $country = null,
        ?array $excludeSelectors = null,
        ?array $extractRules = null,
        ?array $headers = null,
        bool $includeFrames = false,
        ?array $includeSelectors = null,
        ?int $maxAgeMs = 86400000,
        \ContextDev\Web\WebWebScrapeHTMLParams\Pdf|array $pdf = [
            'shouldParse' => true, 'ocr' => false,
        ],
        bool $settleAnimations = false,
        ?array $tags = null,
        \ContextDev\Web\WebWebScrapeHTMLParams\TimeoutOpts|array|null $timeoutOpts = null,
        bool $useMainContentOnly = false,
        ?int $waitForMs = null,
        \ContextDev\Web\WebWebScrapeHTMLParams\Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): WebWebScrapeHTMLResponse;

    /**
     * @api
     *
     * @param string $url Page URL to inspect. Must include http:// or https://.
     * @param list<ActionShape2>|null $actions Optional browser actions executed in array order after the page loads and before content is captured. Requires a paid plan. Send a JSON array in the query parameter. Maximum: 5 actions.
     * @param \ContextDev\Web\WebWebScrapeImagesParams\Country|value-of<\ContextDev\Web\WebWebScrapeImagesParams\Country> $country fetch the target page through a residential proxy in this country (ISO 3166-1 alpha-2)
     * @param bool $dedupe When true, visually duplicate images are removed: every image is loaded and perceptually hashed, and only the highest-resolution copy of each duplicate group is kept. Images that cannot be downloaded or hashed are kept. Default: false.
     * @param Enrichment|EnrichmentShape|null $enrichment optional per-image processing, sent as deep-object query params such as enrichment[resolution]=true
     * @param array<string,string> $headers Optional outbound HTTP headers forwarded only to the target URL, sent as deep-object query params such as headers[X-Custom]=value. When provided, caching is bypassed: the result is neither read from nor written to cache.
     * @param int|null $maxAgeMs Reuse a cached result this many milliseconds old or newer. Default: 86400000 (1 day). Set to 0 to bypass cache. Maximum: 2592000000 (30 days).
     * @param list<string> $tags Comma-separated tags for tracking request usage. Up to 20 tags, each 1-50 characters.
     * @param \ContextDev\Web\WebWebScrapeImagesParams\TimeoutOpts|TimeoutOptsShape10 $timeoutOpts Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     * @param int|null $waitForMs Optional browser wait time in milliseconds after initial page load before collecting images. Min: 0. Max: 30000 (30 seconds). When combined with timeoutOpts, timeoutOpts.milliseconds must be at least waitForMs + 10000 ms; a shorter deadline is rejected with 400 TIMEOUT_TOO_SHORT_FOR_WAIT.
     * @param \ContextDev\Web\WebWebScrapeImagesParams\Zdr|value-of<\ContextDev\Web\WebWebScrapeImagesParams\Zdr> $zdr Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Asset uploads are skipped, so hosted image URLs are omitted. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function webScrapeImages(
        string $url,
        ?array $actions = null,
        \ContextDev\Web\WebWebScrapeImagesParams\Country|string|null $country = null,
        bool $dedupe = false,
        Enrichment|array|null $enrichment = null,
        ?array $headers = null,
        ?int $maxAgeMs = 86400000,
        ?array $tags = null,
        \ContextDev\Web\WebWebScrapeImagesParams\TimeoutOpts|array|null $timeoutOpts = null,
        ?int $waitForMs = null,
        \ContextDev\Web\WebWebScrapeImagesParams\Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): WebWebScrapeImagesResponse;

    /**
     * @api
     *
     * @param string $url Full URL to scrape into LLM usable Markdown (must include http:// or https:// protocol)
     * @param list<ActionShape3>|null $actions Optional browser actions executed in array order after the page loads and before content is captured. Requires a paid plan. Send a JSON array in the query parameter. Maximum: 5 actions.
     * @param \ContextDev\Web\WebWebScrapeMdParams\Country|value-of<\ContextDev\Web\WebWebScrapeMdParams\Country> $country fetch the target page through a residential proxy in this country (ISO 3166-1 alpha-2)
     * @param list<string>|null $excludeSelectors CSS selectors to remove before conversion to Markdown. Applied after includeSelectors. Exclusion takes precedence: an element matching both is removed. Examples: "nav", "footer", ".ad-banner", "[aria-hidden=true]".
     * @param array<string,string> $headers Optional outbound HTTP headers forwarded only to the target URL, sent as deep-object query params such as headers[X-Custom]=value. When provided, caching is bypassed: the result is neither read from nor written to cache.
     * @param bool $includeFrames when true, the contents of iframes are rendered to Markdown
     * @param bool $includeHTML when true, the response also includes an `html` field with the page HTML the Markdown was converted from — the same body the Scrape HTML endpoint returns for the equivalent request
     * @param bool $includeImages Include image references in Markdown output
     * @param bool $includeLinks Preserve hyperlinks in Markdown output
     * @param list<string>|null $includeSelectors CSS selectors. When provided, only matching HTML subtrees (and their descendants) are kept before conversion to Markdown. When omitted, the entire document is kept. Examples: "article.main", "#content", "[role=main]".
     * @param int|null $maxAgeMs Return a cached result if a prior scrape for the same parameters exists and is younger than this many milliseconds. Defaults to 1 day (86400000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always scrape fresh.
     * @param \ContextDev\Web\WebWebScrapeMdParams\Pdf|PdfShape3 $pdf PDF parsing controls. Use start/end to limit text extraction and embedded-image detection/OCR to an inclusive 1-based page range.
     * @param bool $settleAnimations When true, waits briefly for CSS and transition animations to settle before converting to Markdown. Defaults to false. This adds a bit of latency in exchange for more stable output on animated pages.
     * @param bool $shortenBase64Images Shorten base64-encoded image data in the Markdown output
     * @param list<string> $tags Comma-separated tags for tracking request usage. Up to 20 tags, each 1-50 characters.
     * @param \ContextDev\Web\WebWebScrapeMdParams\TimeoutOpts|TimeoutOptsShape11 $timeoutOpts Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     * @param bool $useMainContentOnly Extract only the main content of the page, excluding headers, footers, sidebars, and navigation
     * @param int|null $waitForMs Optional browser wait time in milliseconds after initial page load before converting the page to Markdown. Min: 0. Max: 30000 (30 seconds). When combined with timeoutOpts, timeoutOpts.milliseconds must be at least waitForMs + 10000 ms; a shorter deadline is rejected with 400 TIMEOUT_TOO_SHORT_FOR_WAIT.
     * @param \ContextDev\Web\WebWebScrapeMdParams\Zdr|value-of<\ContextDev\Web\WebWebScrapeMdParams\Zdr> $zdr Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Asset uploads are skipped, so hosted image URLs are omitted. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function webScrapeMd(
        string $url,
        ?array $actions = null,
        \ContextDev\Web\WebWebScrapeMdParams\Country|string|null $country = null,
        ?array $excludeSelectors = null,
        ?array $headers = null,
        bool $includeFrames = false,
        bool $includeHTML = false,
        bool $includeImages = false,
        bool $includeLinks = true,
        ?array $includeSelectors = null,
        ?int $maxAgeMs = 86400000,
        \ContextDev\Web\WebWebScrapeMdParams\Pdf|array $pdf = [
            'shouldParse' => true, 'ocr' => false,
        ],
        bool $settleAnimations = false,
        bool $shortenBase64Images = true,
        ?array $tags = null,
        \ContextDev\Web\WebWebScrapeMdParams\TimeoutOpts|array|null $timeoutOpts = null,
        bool $useMainContentOnly = false,
        ?int $waitForMs = null,
        \ContextDev\Web\WebWebScrapeMdParams\Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): WebWebScrapeMdResponse;

    /**
     * @api
     *
     * @param bool $clearPopups Optional parameter for comprehensive popup cleanup. If 'true', the browser dismisses detected cookie/consent UI and clears other detected obstructive popups and overlays before capture. If 'false' or not provided, this parameter requests no cleanup; handleCookiePopup can still request cookie/consent handling independently.
     * @param \ContextDev\Web\WebWebScrapeScreenshotParams\ColorScheme|value-of<\ContextDev\Web\WebWebScrapeScreenshotParams\ColorScheme> $colorScheme Optional parameter to choose the site's visual theme in the screenshot. Use 'light' or 'dark' when the site offers both appearances.
     * @param \ContextDev\Web\WebWebScrapeScreenshotParams\Country|value-of<\ContextDev\Web\WebWebScrapeScreenshotParams\Country> $country fetch the target page through a residential proxy in this country (ISO 3166-1 alpha-2)
     * @param \ContextDev\Web\WebWebScrapeScreenshotParams\FullScreenshot|value-of<\ContextDev\Web\WebWebScrapeScreenshotParams\FullScreenshot> $fullScreenshot Optional parameter to determine screenshot type. If 'true', takes a full page screenshot capturing all content. If 'false' or not provided, takes a viewport screenshot (standard browser view).
     * @param bool $handleCookiePopup Optional parameter to control cookie/consent popup handling. If 'true', we dismiss cookie banner before capture. If 'false' or not provided, captures the page without that step.
     * @param array<string,string> $headers Optional outbound HTTP headers, using the same JSON object or deep-object query format as other scrape endpoints (for example headers[Authorization]=Bearer token). Headers are scoped to the target origin during capture. For domain/page requests, discovery receives no custom headers and only pages on the resolved origin are eligible. Non-empty headers bypass screenshot caching and return an in-memory data URL; no screenshot is uploaded. Empty objects behave like omitted headers.
     * @param int|null $maxAgeMs Return a cached screenshot if a prior screenshot for the same parameters exists and is younger than this many milliseconds. Defaults to 1 day (86400000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always capture fresh.
     * @param int|null $scrollOffset Optional vertical scroll offset in pixels for capturing a long page in viewport-sized chunks. When provided, the full page is captured once and the returned image is the viewport-sized slice that begins at this Y offset (e.g. request scrollOffset=0, then 1080, then 2160 to walk a 1920x1080 landing page top to bottom). The final slice may be shorter than the viewport height. Takes precedence over fullScreenshot. Max: 100000.
     * @param list<string> $tags Comma-separated tags for tracking request usage. Up to 20 tags, each 1-50 characters.
     * @param \ContextDev\Web\WebWebScrapeScreenshotParams\TimeoutOpts|TimeoutOptsShape12 $timeoutOpts Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     * @param \ContextDev\Web\WebWebScrapeScreenshotParams\Viewport|ViewportShape1 $viewport Optional browser viewport dimensions for the screenshot. Defaults to 1920x1080.
     * @param int|null $waitForMs Optional browser wait time in milliseconds after initial page load before taking the screenshot. Min: 0. Max: 30000 (30 seconds). Defaults to 3000 ms when omitted. When combined with timeoutOpts, timeoutOpts.milliseconds must be at least waitForMs + 10000 ms; a shorter deadline is rejected with 400 TIMEOUT_TOO_SHORT_FOR_WAIT.
     * @param \ContextDev\Web\WebWebScrapeScreenshotParams\Zdr|value-of<\ContextDev\Web\WebWebScrapeScreenshotParams\Zdr> $zdr Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Asset uploads are skipped, so hosted image URLs are omitted. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function webScrapeScreenshot(
        string $url,
        bool $clearPopups = false,
        \ContextDev\Web\WebWebScrapeScreenshotParams\ColorScheme|string|null $colorScheme = null,
        \ContextDev\Web\WebWebScrapeScreenshotParams\Country|string|null $country = null,
        \ContextDev\Web\WebWebScrapeScreenshotParams\FullScreenshot|string|null $fullScreenshot = null,
        bool $handleCookiePopup = false,
        ?array $headers = null,
        ?int $maxAgeMs = 86400000,
        ?int $scrollOffset = null,
        ?array $tags = null,
        \ContextDev\Web\WebWebScrapeScreenshotParams\TimeoutOpts|array|null $timeoutOpts = null,
        \ContextDev\Web\WebWebScrapeScreenshotParams\Viewport|array $viewport = [
            'width' => 1920, 'height' => 1080,
        ],
        ?int $waitForMs = 3000,
        \ContextDev\Web\WebWebScrapeScreenshotParams\Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): WebWebScrapeScreenshotResponse;

    /**
     * @api
     *
     * @param string $domain Domain to build a sitemap for
     * @param array<string,string> $headers Optional outbound HTTP headers forwarded only to the target URL, sent as deep-object query params such as headers[X-Custom]=value. When provided, caching is bypassed: the result is neither read from nor written to cache.
     * @param bool $includeSubdomains When true, discover and include public pages and sitemaps on subdomains of the requested domain. Defaults to false.
     * @param int $maxLinks Maximum number of links to return from the sitemap crawl. Defaults to 10,000. Minimum is 1, maximum is 100,000.
     * @param string $search Optional search phrase. When provided, the crawled sitemap is filtered to the pages whose URLs are about that phrase, most relevant first, and the request costs 2 credits instead of 1.
     * @param string $sitemapURL Optional explicit sitemap URL. When provided, exactly this sitemap is crawled instead of discovering the domain's sitemaps.
     * @param list<string> $tags Comma-separated tags for tracking request usage. Up to 20 tags, each 1-50 characters.
     * @param \ContextDev\Web\WebWebScrapeSitemapParams\TimeoutOpts|TimeoutOptsShape13 $timeoutOpts Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     * @param string $urlRegex Optional RE2-compatible regex pattern. Only URLs matching this pattern are returned and counted against maxLinks.
     * @param \ContextDev\Web\WebWebScrapeSitemapParams\Zdr|value-of<\ContextDev\Web\WebWebScrapeSitemapParams\Zdr> $zdr Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Asset uploads are skipped, so hosted image URLs are omitted. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function webScrapeSitemap(
        string $domain,
        ?array $headers = null,
        bool $includeSubdomains = false,
        int $maxLinks = 10000,
        ?string $search = null,
        ?string $sitemapURL = null,
        ?array $tags = null,
        \ContextDev\Web\WebWebScrapeSitemapParams\TimeoutOpts|array|null $timeoutOpts = null,
        ?string $urlRegex = null,
        \ContextDev\Web\WebWebScrapeSitemapParams\Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): WebWebScrapeSitemapResponse;
}
