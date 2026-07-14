<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\WebContract;
use ContextDev\Web\WebExtractCompetitorsResponse;
use ContextDev\Web\WebExtractFontsResponse;
use ContextDev\Web\WebExtractParams\Pdf;
use ContextDev\Web\WebExtractResponse;
use ContextDev\Web\WebExtractStyleguideParams\ColorScheme;
use ContextDev\Web\WebExtractStyleguideResponse;
use ContextDev\Web\WebScreenshotParams\Country;
use ContextDev\Web\WebScreenshotParams\FullScreenshot;
use ContextDev\Web\WebScreenshotParams\HandleCookiePopup\UnionMember1;
use ContextDev\Web\WebScreenshotParams\Page;
use ContextDev\Web\WebScreenshotParams\Viewport;
use ContextDev\Web\WebScreenshotResponse;
use ContextDev\Web\WebSearchParams\Freshness;
use ContextDev\Web\WebSearchParams\MarkdownOptions;
use ContextDev\Web\WebSearchResponse;
use ContextDev\Web\WebWebCrawlMdResponse;
use ContextDev\Web\WebWebScrapeHTMLResponse;
use ContextDev\Web\WebWebScrapeImagesParams\Enrichment;
use ContextDev\Web\WebWebScrapeImagesResponse;
use ContextDev\Web\WebWebScrapeMdResponse;
use ContextDev\Web\WebWebScrapeSitemapResponse;

/**
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebExtractParams\Pdf
 * @phpstan-import-type HandleCookiePopupShape from \ContextDev\Web\WebScreenshotParams\HandleCookiePopup
 * @phpstan-import-type ViewportShape from \ContextDev\Web\WebScreenshotParams\Viewport
 * @phpstan-import-type MarkdownOptionsShape from \ContextDev\Web\WebSearchParams\MarkdownOptions
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebWebCrawlMdParams\Pdf as PdfShape1
 * @phpstan-import-type IncludeFramesShape from \ContextDev\Web\WebWebScrapeHTMLParams\IncludeFrames
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebWebScrapeHTMLParams\Pdf as PdfShape2
 * @phpstan-import-type SettleAnimationsShape from \ContextDev\Web\WebWebScrapeHTMLParams\SettleAnimations
 * @phpstan-import-type UseMainContentOnlyShape from \ContextDev\Web\WebWebScrapeHTMLParams\UseMainContentOnly
 * @phpstan-import-type DedupeShape from \ContextDev\Web\WebWebScrapeImagesParams\Dedupe
 * @phpstan-import-type EnrichmentShape from \ContextDev\Web\WebWebScrapeImagesParams\Enrichment
 * @phpstan-import-type IncludeFramesShape from \ContextDev\Web\WebWebScrapeMdParams\IncludeFrames as IncludeFramesShape1
 * @phpstan-import-type IncludeImagesShape from \ContextDev\Web\WebWebScrapeMdParams\IncludeImages
 * @phpstan-import-type IncludeLinksShape from \ContextDev\Web\WebWebScrapeMdParams\IncludeLinks
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebWebScrapeMdParams\Pdf as PdfShape3
 * @phpstan-import-type SettleAnimationsShape from \ContextDev\Web\WebWebScrapeMdParams\SettleAnimations as SettleAnimationsShape1
 * @phpstan-import-type ShortenBase64ImagesShape from \ContextDev\Web\WebWebScrapeMdParams\ShortenBase64Images
 * @phpstan-import-type UseMainContentOnlyShape from \ContextDev\Web\WebWebScrapeMdParams\UseMainContentOnly as UseMainContentOnlyShape1
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
     * Crawl a website, use the provided JSON Schema and instructions to prioritize relevant internal links, and extract structured data from the selected pages.
     *
     * @param array<string,mixed> $schema JSON Schema for the returned data object. TypeScript Zod users can pass a JSON Schema generated from a Zod object; Python users can pass the equivalent JSON Schema object.
     * @param string $url The starting website URL to crawl and extract from. Must include http:// or https://.
     * @param bool $factCheck When true, every returned value must be grounded in facts stated on the page; fields that cannot be supported by the page are returned as null/empty. When false (default), the model may make reasonable inferences and derivations from the page content (e.g. ideal customer, competitor analysis, recommendations) while keeping verifiable specifics (names, quotes, URLs, dates, metrics) faithful to the source.
     * @param bool $followSubdomains when true, follow links on subdomains of the starting URL's domain
     * @param bool $includeFrames when true, iframe contents are included in Markdown before extraction
     * @param string $instructions optional extraction guidance, such as which facts to prioritize or how to interpret fields in the schema
     * @param int $maxAgeMs Return cached scrape results if a prior scrape for the same parameters is younger than this many milliseconds. Defaults to 7 days (604800000 ms).
     * @param int $maxDepth Optional maximum link depth from the starting URL (0 = only the starting page). If omitted, there is no crawl depth limit.
     * @param int $maxPages Maximum number of pages to analyze for extraction. Hard cap: 50. Defaults to 5.
     * @param Pdf|PdfShape $pdf
     * @param int $stopAfterMs Soft time budget for the crawl in milliseconds. Min: 10000 (10s). Max: 110000 (110s). Default: 80000 (80s).
     * @param list<string> $tags Optional caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param int $waitForMs optional browser wait time in milliseconds after initial page load for each crawled page
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function extract(
        array $schema,
        string $url,
        bool $factCheck = false,
        bool $followSubdomains = false,
        bool $includeFrames = false,
        ?string $instructions = null,
        int $maxAgeMs = 604800000,
        ?int $maxDepth = null,
        int $maxPages = 5,
        Pdf|array $pdf = ['shouldParse' => true],
        int $stopAfterMs = 80000,
        ?array $tags = null,
        ?int $timeoutMs = null,
        ?int $waitForMs = null,
        RequestOptions|array|null $requestOptions = null,
    ): WebExtractResponse {
        $params = Util::removeNulls(
            [
                'schema' => $schema,
                'url' => $url,
                'factCheck' => $factCheck,
                'followSubdomains' => $followSubdomains,
                'includeFrames' => $includeFrames,
                'instructions' => $instructions,
                'maxAgeMs' => $maxAgeMs,
                'maxDepth' => $maxDepth,
                'maxPages' => $maxPages,
                'pdf' => $pdf,
                'stopAfterMs' => $stopAfterMs,
                'tags' => $tags,
                'timeoutMs' => $timeoutMs,
                'waitForMs' => $waitForMs,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->extract(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Analyze a company's landing page and web search evidence to return direct competitors for the same product or market.
     *
     * @param string $domain Company domain to analyze, such as `stripe.com`. Full http(s) URLs are accepted and normalized to their domain.
     * @param int $numCompetitors Exact number of direct competitors to return. Defaults to 5.
     * @param list<string> $tags Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function extractCompetitors(
        string $domain,
        int $numCompetitors = 5,
        ?array $tags = null,
        ?int $timeoutMs = null,
        RequestOptions|array|null $requestOptions = null,
    ): WebExtractCompetitorsResponse {
        $params = Util::removeNulls(
            [
                'domain' => $domain,
                'numCompetitors' => $numCompetitors,
                'tags' => $tags,
                'timeoutMs' => $timeoutMs,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->extractCompetitors(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Scrape font information from a website including font families, usage statistics, fallbacks, and element/word counts.
     *
     * @param string $directURL A specific URL to fetch fonts from directly, bypassing domain resolution (e.g., 'https://example.com/design-system'). When provided, fonts are extracted from this exact URL. You must provide either 'domain' or 'directUrl', but not both.
     * @param string $domain Domain name to extract fonts from (e.g., 'example.com', 'google.com'). The domain will be automatically normalized and validated. You must provide either 'domain' or 'directUrl', but not both.
     * @param int|null $maxAgeMs Maximum age in milliseconds for cached brand data before the API performs a hard refresh. Defaults to 3 months (7776000000 ms). Values below 1 day (86400000 ms) are clamped to 1 day; values above 1 year (31536000000 ms) are clamped to 1 year.
     * @param list<string> $tags Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function extractFonts(
        ?string $directURL = null,
        ?string $domain = null,
        ?int $maxAgeMs = 7776000000,
        ?array $tags = null,
        ?int $timeoutMs = null,
        RequestOptions|array|null $requestOptions = null,
    ): WebExtractFontsResponse {
        $params = Util::removeNulls(
            [
                'directURL' => $directURL,
                'domain' => $domain,
                'maxAgeMs' => $maxAgeMs,
                'tags' => $tags,
                'timeoutMs' => $timeoutMs,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->extractFonts(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Extract a comprehensive design system from a website including colors, typography, spacing, shadows, and UI components.
     *
     * @param ColorScheme|value-of<ColorScheme> $colorScheme Optional browser color scheme to emulate for websites that respond to prefers-color-scheme. This value is part of the styleguide cache key.
     * @param string $directURL A specific URL to fetch the styleguide from directly, bypassing domain resolution (e.g., 'https://example.com/design-system'). When provided, the styleguide is extracted from this exact URL. You must provide either 'domain' or 'directUrl', but not both.
     * @param string $domain Domain name to extract styleguide from (e.g., 'example.com', 'google.com'). The domain will be automatically normalized and validated. You must provide either 'domain' or 'directUrl', but not both.
     * @param int|null $maxAgeMs Maximum age in milliseconds for cached brand data before the API performs a hard refresh. Defaults to 3 months (7776000000 ms). Values below 1 day (86400000 ms) are clamped to 1 day; values above 1 year (31536000000 ms) are clamped to 1 year.
     * @param list<string> $tags Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
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
        ?int $timeoutMs = null,
        RequestOptions|array|null $requestOptions = null,
    ): WebExtractStyleguideResponse {
        $params = Util::removeNulls(
            [
                'colorScheme' => $colorScheme,
                'directURL' => $directURL,
                'domain' => $domain,
                'maxAgeMs' => $maxAgeMs,
                'tags' => $tags,
                'timeoutMs' => $timeoutMs,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->extractStyleguide(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Capture a screenshot of a website.
     *
     * @param \ContextDev\Web\WebScreenshotParams\ColorScheme|value-of<\ContextDev\Web\WebScreenshotParams\ColorScheme> $colorScheme Optional parameter to choose the site's visual theme in the screenshot. Use 'light' or 'dark' when the site offers both appearances.
     * @param Country|value-of<Country> $country Two-letter ISO 3166-1 alpha-2 country code identifying a supported Context.dev residential proxy exit location. Must be one of Context.dev's supported countries. When provided, Context.dev fetches the target page from that country.
     * @param string $directURL A specific URL to screenshot directly, bypassing domain resolution (e.g., 'https://example.com/pricing'). When provided, the screenshot is taken of this exact URL. You must provide either 'domain' or 'directUrl', but not both.
     * @param string $domain Domain name to take screenshot of (e.g., 'example.com', 'google.com'). The domain will be automatically normalized and validated. You must provide either 'domain' or 'directUrl', but not both.
     * @param FullScreenshot|value-of<FullScreenshot> $fullScreenshot Optional parameter to determine screenshot type. If 'true', takes a full page screenshot capturing all content. If 'false' or not provided, takes a viewport screenshot (standard browser view).
     * @param HandleCookiePopupShape $handleCookiePopup Optional parameter to control cookie/consent popup handling. If 'true', we dismiss cookie banner before capture. If 'false' or not provided, captures the page without that step.
     * @param int|null $maxAgeMs Return a cached screenshot if a prior screenshot for the same parameters exists and is younger than this many milliseconds. Defaults to 1 day (86400000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always capture fresh.
     * @param Page|value-of<Page> $page Optional parameter to specify which page type to screenshot. If provided, the system will scrape the domain's links and use heuristics to find the most appropriate URL for the specified page type (30 supported languages). If not provided, screenshots the main domain landing page. Only applicable when using 'domain', not 'directUrl'.
     * @param int|null $scrollOffset Optional vertical scroll offset in pixels for capturing a long page in viewport-sized chunks. When provided, the full page is captured once and the returned image is the viewport-sized slice that begins at this Y offset (e.g. request scrollOffset=0, then 1080, then 2160 to walk a 1920x1080 landing page top to bottom). The final slice may be shorter than the viewport height. Takes precedence over fullScreenshot. Max: 100000.
     * @param list<string> $tags Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param Viewport|ViewportShape $viewport Optional browser viewport dimensions for the screenshot. Defaults to 1920x1080.
     * @param int|null $waitForMs Optional browser wait time in milliseconds after initial page load before taking the screenshot. Min: 0. Max: 30000 (30 seconds). Defaults to 3000 ms when omitted.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function screenshot(
        \ContextDev\Web\WebScreenshotParams\ColorScheme|string|null $colorScheme = null,
        Country|string|null $country = null,
        ?string $directURL = null,
        ?string $domain = null,
        FullScreenshot|string|null $fullScreenshot = null,
        bool|UnionMember1|string $handleCookiePopup = false,
        ?int $maxAgeMs = 86400000,
        Page|string|null $page = null,
        ?int $scrollOffset = null,
        ?array $tags = null,
        ?int $timeoutMs = null,
        Viewport|array $viewport = ['width' => 1920, 'height' => 1080],
        ?int $waitForMs = 3000,
        RequestOptions|array|null $requestOptions = null,
    ): WebScreenshotResponse {
        $params = Util::removeNulls(
            [
                'colorScheme' => $colorScheme,
                'country' => $country,
                'directURL' => $directURL,
                'domain' => $domain,
                'fullScreenshot' => $fullScreenshot,
                'handleCookiePopup' => $handleCookiePopup,
                'maxAgeMs' => $maxAgeMs,
                'page' => $page,
                'scrollOffset' => $scrollOffset,
                'tags' => $tags,
                'timeoutMs' => $timeoutMs,
                'viewport' => $viewport,
                'waitForMs' => $waitForMs,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->screenshot(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Search the web and optionally scrape each result to Markdown in one round-trip.
     *
     * @param string $query Search query. Accepts natural language as well as Google-style search operators such as `site:`, `-site:`, `inurl:`, `intitle:`, quoted phrases, and `OR`.
     * @param \ContextDev\Web\WebSearchParams\Country|value-of<\ContextDev\Web\WebSearchParams\Country> $country Two-letter ISO 3166-1 alpha-2 country code to localize results to a specific country (maps to Google's `gl` parameter). Example: "us", "gb", "de".
     * @param list<string> $excludeDomains Blocklist — drop results from these domains. Example: ["pinterest.com", "reddit.com"].
     * @param Freshness|value-of<Freshness> $freshness restrict results to content published within this window
     * @param list<string> $includeDomains Allowlist — only return results from these domains. Example: ["arxiv.org", "github.com"].
     * @param MarkdownOptions|MarkdownOptionsShape $markdownOptions Inline Markdown scraping for each result. Set `enabled: true` to activate.
     * @param int $numResults Number of results to request and return (10–100). Defaults to 10.
     * @param bool $queryFanout expand the query into multiple parallel variants for broader recall
     * @param list<string> $tags Optional caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
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
        ?int $timeoutMs = null,
        RequestOptions|array|null $requestOptions = null,
    ): WebSearchResponse {
        $params = Util::removeNulls(
            [
                'query' => $query,
                'country' => $country,
                'excludeDomains' => $excludeDomains,
                'freshness' => $freshness,
                'includeDomains' => $includeDomains,
                'markdownOptions' => $markdownOptions,
                'numResults' => $numResults,
                'queryFanout' => $queryFanout,
                'tags' => $tags,
                'timeoutMs' => $timeoutMs,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->search(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Performs a crawl starting from a given URL, extracts page content as Markdown, and returns results for all crawled pages.
     *
     * @param string $url The starting URL for the crawl (must include http:// or https:// protocol)
     * @param \ContextDev\Web\WebWebCrawlMdParams\Country|value-of<\ContextDev\Web\WebWebCrawlMdParams\Country> $country Two-letter ISO 3166-1 alpha-2 country code identifying a supported Context.dev residential proxy exit location. Must be one of Context.dev's supported countries. When provided, Context.dev fetches the target page from that country.
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
     * @param list<string> $tags Optional caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param string $urlRegex Regex pattern. Only URLs matching this pattern will be followed and scraped.
     * @param bool $useMainContentOnly Extract only the main content, stripping headers, footers, sidebars, and navigation
     * @param int $waitForMs Optional browser wait time in milliseconds after initial page load for each crawled page. Min: 0. Max: 30000 (30 seconds).
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
        ?int $timeoutMs = null,
        ?string $urlRegex = null,
        bool $useMainContentOnly = false,
        ?int $waitForMs = null,
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
                'timeoutMs' => $timeoutMs,
                'urlRegex' => $urlRegex,
                'useMainContentOnly' => $useMainContentOnly,
                'waitForMs' => $waitForMs,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->webCrawlMd(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Scrapes the given URL and returns the raw HTML content of the page.
     *
     * @param string $url Full URL to scrape (must include http:// or https:// protocol)
     * @param \ContextDev\Web\WebWebScrapeHTMLParams\Country|value-of<\ContextDev\Web\WebWebScrapeHTMLParams\Country> $country Two-letter ISO 3166-1 alpha-2 country code identifying a supported Context.dev residential proxy exit location. Must be one of Context.dev's supported countries. When provided, Context.dev fetches the target page from that country.
     * @param list<string>|null $excludeSelectors CSS selectors to remove from the result. Applied after includeSelectors. Exclusion takes precedence: an element matching both is removed. Examples: "nav", "footer", ".ad-banner", "[aria-hidden=true]".
     * @param array<string,string> $headers Optional outbound HTTP headers forwarded only to the target URL, sent as deep-object query params such as headers[X-Custom]=value. When provided, caching is bypassed: the result is neither read from nor written to cache.
     * @param IncludeFramesShape $includeFrames when true, iframes are rendered inline into the returned HTML
     * @param list<string>|null $includeSelectors CSS selectors. When provided, only matching subtrees (and their descendants) are kept and everything else is dropped. When omitted, the entire document is kept. Examples: "article.main", "#content", "[role=main]".
     * @param int|null $maxAgeMs Return a cached result if a prior scrape for the same parameters exists and is younger than this many milliseconds. Defaults to 1 day (86400000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always scrape fresh.
     * @param \ContextDev\Web\WebWebScrapeHTMLParams\Pdf|PdfShape2 $pdf PDF parsing controls. Use start/end to limit text extraction and embedded-image detection/OCR to an inclusive 1-based page range.
     * @param SettleAnimationsShape $settleAnimations When true, waits briefly for CSS and transition animations to settle before extracting HTML. Defaults to false. This adds a bit of latency in exchange for more stable output on animated pages.
     * @param list<string> $tags Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param UseMainContentOnlyShape $useMainContentOnly when true, return only the page's main content in the HTML response, excluding headers, footers, sidebars, and navigation when detectable
     * @param int|null $waitForMs Optional browser wait time in milliseconds after initial page load. Min: 0. Max: 30000 (30 seconds).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function webScrapeHTML(
        string $url,
        \ContextDev\Web\WebWebScrapeHTMLParams\Country|string|null $country = null,
        ?array $excludeSelectors = null,
        ?array $headers = null,
        bool|\ContextDev\Web\WebWebScrapeHTMLParams\IncludeFrames\UnionMember1|string $includeFrames = false,
        ?array $includeSelectors = null,
        ?int $maxAgeMs = 86400000,
        \ContextDev\Web\WebWebScrapeHTMLParams\Pdf|array $pdf = [
            'shouldParse' => true, 'ocr' => false,
        ],
        bool|\ContextDev\Web\WebWebScrapeHTMLParams\SettleAnimations\UnionMember1|string $settleAnimations = false,
        ?array $tags = null,
        ?int $timeoutMs = null,
        bool|\ContextDev\Web\WebWebScrapeHTMLParams\UseMainContentOnly\UnionMember1|string $useMainContentOnly = false,
        ?int $waitForMs = null,
        RequestOptions|array|null $requestOptions = null,
    ): WebWebScrapeHTMLResponse {
        $params = Util::removeNulls(
            [
                'url' => $url,
                'country' => $country,
                'excludeSelectors' => $excludeSelectors,
                'headers' => $headers,
                'includeFrames' => $includeFrames,
                'includeSelectors' => $includeSelectors,
                'maxAgeMs' => $maxAgeMs,
                'pdf' => $pdf,
                'settleAnimations' => $settleAnimations,
                'tags' => $tags,
                'timeoutMs' => $timeoutMs,
                'useMainContentOnly' => $useMainContentOnly,
                'waitForMs' => $waitForMs,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->webScrapeHTML(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Extract image assets from a web page, including standard URLs, inline SVGs, data URIs, responsive image sources, metadata, CSS backgrounds, video posters, and embeds. The base request costs 1 credit. When enrichment is enabled, the entire call costs 5 credits.
     *
     * @param string $url Page URL to inspect. Must include http:// or https://.
     * @param DedupeShape $dedupe When true, visually duplicate images are removed: every image is loaded and perceptually hashed, and only the highest-resolution copy of each duplicate group is kept. Images that cannot be downloaded or hashed are kept. Default: false.
     * @param Enrichment|EnrichmentShape|null $enrichment optional per-image processing, sent as deep-object query params such as enrichment[resolution]=true
     * @param array<string,string> $headers Optional outbound HTTP headers forwarded only to the target URL, sent as deep-object query params such as headers[X-Custom]=value. When provided, caching is bypassed: the result is neither read from nor written to cache.
     * @param int|null $maxAgeMs Reuse a cached result this many milliseconds old or newer. Default: 86400000 (1 day). Set to 0 to bypass cache. Maximum: 2592000000 (30 days).
     * @param list<string> $tags Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param int|null $waitForMs Optional browser wait time in milliseconds after initial page load before collecting images. Min: 0. Max: 30000 (30 seconds).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function webScrapeImages(
        string $url,
        bool|\ContextDev\Web\WebWebScrapeImagesParams\Dedupe\UnionMember1|string $dedupe = false,
        Enrichment|array|null $enrichment = null,
        ?array $headers = null,
        ?int $maxAgeMs = 86400000,
        ?array $tags = null,
        ?int $timeoutMs = null,
        ?int $waitForMs = null,
        RequestOptions|array|null $requestOptions = null,
    ): WebWebScrapeImagesResponse {
        $params = Util::removeNulls(
            [
                'url' => $url,
                'dedupe' => $dedupe,
                'enrichment' => $enrichment,
                'headers' => $headers,
                'maxAgeMs' => $maxAgeMs,
                'tags' => $tags,
                'timeoutMs' => $timeoutMs,
                'waitForMs' => $waitForMs,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->webScrapeImages(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Scrapes the given URL into LLM usable Markdown. Inspect key_metadata on JSON responses from a recognized API key; use error_code to distinguish stable failure categories.
     *
     * ### Billing & errors
     *
     * | HTTP status | Billed? | Meaning |
     * | --- | --- | --- |
     * | 200 | Yes — 1 credit | Successful scrape, including a zero-length result when includeSelectors matched nothing |
     * | 400 | No | Invalid input, skipped PDF, or the page could not be scraped |
     * | 401 / 403 | No | Invalid/disabled key, insufficient permissions, or credits exhausted; inspect error_code |
     * | 404 | No | Target page returned or fingerprinted as not found |
     * | 408 | No | Request timed out |
     * | 415 | No | Unsupported content type |
     * | 429 | No | Per-minute rate limit exceeded; honor Retry-After |
     * | 500 | No | Internal error |
     *
     * @param string $url Full URL to scrape into LLM usable Markdown (must include http:// or https:// protocol)
     * @param \ContextDev\Web\WebWebScrapeMdParams\Country|value-of<\ContextDev\Web\WebWebScrapeMdParams\Country> $country Two-letter ISO 3166-1 alpha-2 country code identifying a supported Context.dev residential proxy exit location. Must be one of Context.dev's supported countries. When provided, Context.dev fetches the target page from that country.
     * @param list<string>|null $excludeSelectors CSS selectors to remove before conversion to Markdown. Applied after includeSelectors. Exclusion takes precedence: an element matching both is removed. Examples: "nav", "footer", ".ad-banner", "[aria-hidden=true]".
     * @param array<string,string> $headers Optional outbound HTTP headers forwarded only to the target URL, sent as deep-object query params such as headers[X-Custom]=value. When provided, caching is bypassed: the result is neither read from nor written to cache.
     * @param IncludeFramesShape1 $includeFrames when true, the contents of iframes are rendered to Markdown
     * @param IncludeImagesShape $includeImages Include image references in Markdown output
     * @param IncludeLinksShape $includeLinks Preserve hyperlinks in Markdown output
     * @param list<string>|null $includeSelectors CSS selectors. When provided, only matching HTML subtrees (and their descendants) are kept before conversion to Markdown. When omitted, the entire document is kept. Examples: "article.main", "#content", "[role=main]".
     * @param int|null $maxAgeMs Return a cached result if a prior scrape for the same parameters exists and is younger than this many milliseconds. Defaults to 1 day (86400000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always scrape fresh.
     * @param \ContextDev\Web\WebWebScrapeMdParams\Pdf|PdfShape3 $pdf PDF parsing controls. Use start/end to limit text extraction and embedded-image detection/OCR to an inclusive 1-based page range.
     * @param SettleAnimationsShape1 $settleAnimations When true, waits briefly for CSS and transition animations to settle before converting to Markdown. Defaults to false. This adds a bit of latency in exchange for more stable output on animated pages.
     * @param ShortenBase64ImagesShape $shortenBase64Images Shorten base64-encoded image data in the Markdown output
     * @param list<string> $tags Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param UseMainContentOnlyShape1 $useMainContentOnly Extract only the main content of the page, excluding headers, footers, sidebars, and navigation
     * @param int|null $waitForMs Optional browser wait time in milliseconds after initial page load before converting the page to Markdown. Min: 0. Max: 30000 (30 seconds).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function webScrapeMd(
        string $url,
        \ContextDev\Web\WebWebScrapeMdParams\Country|string|null $country = null,
        ?array $excludeSelectors = null,
        ?array $headers = null,
        bool|\ContextDev\Web\WebWebScrapeMdParams\IncludeFrames\UnionMember1|string $includeFrames = false,
        bool|\ContextDev\Web\WebWebScrapeMdParams\IncludeImages\UnionMember1|string $includeImages = false,
        bool|\ContextDev\Web\WebWebScrapeMdParams\IncludeLinks\UnionMember1|string $includeLinks = true,
        ?array $includeSelectors = null,
        ?int $maxAgeMs = 86400000,
        \ContextDev\Web\WebWebScrapeMdParams\Pdf|array $pdf = [
            'shouldParse' => true, 'ocr' => false,
        ],
        bool|\ContextDev\Web\WebWebScrapeMdParams\SettleAnimations\UnionMember1|string $settleAnimations = false,
        bool|\ContextDev\Web\WebWebScrapeMdParams\ShortenBase64Images\UnionMember1|string $shortenBase64Images = true,
        ?array $tags = null,
        ?int $timeoutMs = null,
        bool|\ContextDev\Web\WebWebScrapeMdParams\UseMainContentOnly\UnionMember1|string $useMainContentOnly = false,
        ?int $waitForMs = null,
        RequestOptions|array|null $requestOptions = null,
    ): WebWebScrapeMdResponse {
        $params = Util::removeNulls(
            [
                'url' => $url,
                'country' => $country,
                'excludeSelectors' => $excludeSelectors,
                'headers' => $headers,
                'includeFrames' => $includeFrames,
                'includeImages' => $includeImages,
                'includeLinks' => $includeLinks,
                'includeSelectors' => $includeSelectors,
                'maxAgeMs' => $maxAgeMs,
                'pdf' => $pdf,
                'settleAnimations' => $settleAnimations,
                'shortenBase64Images' => $shortenBase64Images,
                'tags' => $tags,
                'timeoutMs' => $timeoutMs,
                'useMainContentOnly' => $useMainContentOnly,
                'waitForMs' => $waitForMs,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->webScrapeMd(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Crawl an entire website's sitemap and return all discovered page URLs.
     *
     * @param string $domain Domain to build a sitemap for
     * @param array<string,string> $headers Optional outbound HTTP headers forwarded only to the target URL, sent as deep-object query params such as headers[X-Custom]=value. When provided, caching is bypassed: the result is neither read from nor written to cache.
     * @param int $maxLinks Maximum number of links to return from the sitemap crawl. Defaults to 10,000. Minimum is 1, maximum is 100,000.
     * @param string $sitemapURL Optional explicit sitemap URL. When provided, exactly this sitemap is crawled instead of discovering the domain's sitemaps.
     * @param list<string> $tags Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param string $urlRegex Optional RE2-compatible regex pattern. Only URLs matching this pattern are returned and counted against maxLinks.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function webScrapeSitemap(
        string $domain,
        ?array $headers = null,
        int $maxLinks = 10000,
        ?string $sitemapURL = null,
        ?array $tags = null,
        ?int $timeoutMs = null,
        ?string $urlRegex = null,
        RequestOptions|array|null $requestOptions = null,
    ): WebWebScrapeSitemapResponse {
        $params = Util::removeNulls(
            [
                'domain' => $domain,
                'headers' => $headers,
                'maxLinks' => $maxLinks,
                'sitemapURL' => $sitemapURL,
                'tags' => $tags,
                'timeoutMs' => $timeoutMs,
                'urlRegex' => $urlRegex,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->webScrapeSitemap(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
