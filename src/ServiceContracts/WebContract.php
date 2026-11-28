<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;
use ContextDev\Web\WebAnswersParams\Controls;
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
use ContextDev\Web\WebScrapeParams\ParseParams\UnionMember0;
use ContextDev\Web\WebScrapeParams\ParseParams\UnionMember1;
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
use ContextDev\Web\WebWebCrawlMdParams\SourcePreference;
use ContextDev\Web\WebWebCrawlMdResponse;

/**
 * @phpstan-import-type ControlsShape from \ContextDev\Web\WebAnswersParams\Controls
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
 * @phpstan-import-type LanguagesShape from \ContextDev\Web\WebSearchParams\Languages
 * @phpstan-import-type MarkdownOptionsShape from \ContextDev\Web\WebSearchParams\MarkdownOptions
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebSearchParams\TimeoutOpts as TimeoutOptsShape6
 * @phpstan-import-type IncludeFramesShape from \ContextDev\Web\WebWebCrawlMdParams\IncludeFrames
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebWebCrawlMdParams\Pdf
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebWebCrawlMdParams\TimeoutOpts as TimeoutOptsShape7
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface WebContract
{
    /**
     * @api
     *
     * @param string $task What to research, in plain language, up to 2000 characters. Include domains or URLs to focus the research.
     * @param Controls|ControlsShape $controls limit which sites the research can search, read, and cite
     * @param array<string,mixed> $jsonFormat Example of the answer object to return, not a JSON Schema. Up to 8 levels deep, 500 values, and 16,000 characters. Values that cannot be found come back as `null`. Defaults to `{ "result": "" }`.
     * @param Mode|value-of<Mode> $mode `fast` prioritizes speed and adds extra verification for people and companies; `ultra` searches and reads more sources for deeper research. Defaults to `ultra`.
     * @param list<string> $policies Access policy IDs to apply; each URL must pass all of them. Requires access policies enabled for your organization; otherwise returns `ACCESS_POLICIES_NOT_ENABLED`.
     * @param list<string> $tags Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
     * @param TimeoutOpts|TimeoutOptsShape $timeoutOpts request deadline and what to return when it passes
     * @param Zdr|value-of<Zdr> $zdr `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function answers(
        string $task,
        Controls|array|null $controls = null,
        ?array $jsonFormat = null,
        Mode|string|null $mode = null,
        ?array $policies = null,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
        Zdr|string|null $zdr = null,
        RequestOptions|array|null $requestOptions = null,
    ): WebAnswersResponse;

    /**
     * @api
     *
     * @param string $domain Company domain, such as `stripe.com`. Full URLs are reduced to their domain.
     * @param int $numCompetitors exact number of direct competitors to return
     * @param list<string> $tags Comma-separated labels for this request, such as `production,team-alpha`. Filter usage and request logs by them.
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
    ): WebExtractCompetitorsResponse;

    /**
     * @api
     *
     * @param ColorScheme|value-of<ColorScheme> $colorScheme Emulate a light or dark color scheme. Each scheme is cached separately.
     * @param string $directURL Exact page URL to analyze. Provide either `domain` or `directUrl`, not both.
     * @param string $domain Domain to analyze, such as `stripe.com`. Provide either `domain` or `directUrl`, not both.
     * @param int|null $maxAgeMs Maximum age of a cached result, in milliseconds. `0` always fetches fresh. Defaults to 90 days (7776000000 ms). Values above 1 year (31536000000 ms) are capped at 1 year.
     * @param list<string> $policies Comma-separated access policy IDs to apply; each URL must pass all of them. Requires access policies enabled for your organization; otherwise returns `ACCESS_POLICIES_NOT_ENABLED`.
     * @param list<string> $tags Comma-separated labels for this request, such as `production,team-alpha`. Filter usage and request logs by them.
     * @param \ContextDev\Web\WebExtractStyleguideParams\TimeoutOpts|TimeoutOptsShape2 $timeoutOpts request deadline and what to return when it passes
     * @param \ContextDev\Web\WebExtractStyleguideParams\Zdr|value-of<\ContextDev\Web\WebExtractStyleguideParams\Zdr> $zdr `enabled` turns off request logs and traces and keeps request and response content out of usage logs. Brand data and hosted assets may still be stored. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function extractStyleguide(
        ColorScheme|string|null $colorScheme = null,
        ?string $directURL = null,
        ?string $domain = null,
        ?int $maxAgeMs = 7776000000,
        ?array $policies = null,
        ?array $tags = null,
        \ContextDev\Web\WebExtractStyleguideParams\TimeoutOpts|array|null $timeoutOpts = null,
        \ContextDev\Web\WebExtractStyleguideParams\Zdr|string|null $zdr = null,
        RequestOptions|array|null $requestOptions = null,
    ): WebExtractStyleguideResponse;

    /**
     * @api
     *
     * @param string $domain Domain to map, such as `stripe.com`.
     * @param string $excludeURLRegex leave out URLs matching this regex, even when they match `urlRegex`
     * @param array<string,string> $headers HTTP headers to send to the target site. Requests with headers skip the cache.
     * @param bool $includeSubdomains include URLs on subdomains
     * @param int $maxLinks maximum number of URLs to return
     * @param list<string> $policies Comma-separated access policy IDs to apply; each URL must pass all of them. Requires access policies enabled for your organization; otherwise returns `ACCESS_POLICIES_NOT_ENABLED`.
     * @param string $search filter URLs by a topic or phrase, most relevant first
     * @param string $sitemapURL Fetch this sitemap instead of discovering sitemaps. Must belong to the domain or a subdomain.
     * @param list<string> $tags Comma-separated labels for this request, such as `production,team-alpha`. Filter usage and request logs by them.
     * @param \ContextDev\Web\WebMapURLsParams\TimeoutOpts|TimeoutOptsShape3 $timeoutOpts request deadline and what to return when it passes
     * @param string $urlRegex Only return URLs matching this regex. Only matches count toward `maxLinks`.
     * @param \ContextDev\Web\WebMapURLsParams\Zdr|value-of<\ContextDev\Web\WebMapURLsParams\Zdr> $zdr `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function mapUrls(
        string $domain,
        ?string $excludeURLRegex = null,
        ?array $headers = null,
        bool $includeSubdomains = false,
        int $maxLinks = 10000,
        ?array $policies = null,
        ?string $search = null,
        ?string $sitemapURL = null,
        ?array $tags = null,
        \ContextDev\Web\WebMapURLsParams\TimeoutOpts|array|null $timeoutOpts = null,
        ?string $urlRegex = null,
        \ContextDev\Web\WebMapURLsParams\Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): WebMapURLsResponse;

    /**
     * @api
     *
     * @param Formats|FormatsShape $formats Outputs to return. Set at least one to `true`.
     * @param string $url public HTTP or HTTPS URL to scrape
     * @param HighlightsParams|HighlightsParamsShape $highlightsParams Query for the `highlights` output. Required when `formats.highlights` is `true`, and allowed only then.
     * @param ImageParams|ImageParamsShape $imageParams Options for the `images` output. Requires `formats.images: true`.
     * @param JsonParams|JsonParamsShape $jsonParams Schema and instructions for the `json` output. Required when `formats.json` is `true`, and allowed only then.
     * @param MarkdownParams|MarkdownParamsShape $markdownParams Options for the `markdown` output. Requires `formats.markdown: true`.
     * @param int $maxAgeMs Maximum age of a cached result, in milliseconds. `0` always fetches fresh. Defaults to 3 days (259200000 ms). Maximum: 1 year (31536000000 ms).
     * @param ParseParamsShape $parseParams Custom rules or a prebuilt parser for the `parsed` output. Required when `formats.parse` is `true`, and allowed only then.
     * @param list<string> $policies Access policy IDs to apply; each URL must pass all of them. Requires access policies enabled for your organization; otherwise returns `ACCESS_POLICIES_NOT_ENABLED`.
     * @param ProductParams|ProductParamsShape $productParams Options for the `product` output. Requires `formats.product: true`.
     * @param ScreenshotParams|ScreenshotParamsShape $screenshotParams Options for the `screenshot` output. Requires `formats.screenshot: true`.
     * @param SharedParams|SharedParamsShape $sharedParams browser and content settings shared by all outputs
     * @param list<string> $tags Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
     * @param \ContextDev\Web\WebScrapeParams\TimeoutOpts|TimeoutOptsShape4 $timeoutOpts request deadline and what to return when it passes
     * @param \ContextDev\Web\WebScrapeParams\Zdr|value-of<\ContextDev\Web\WebScrapeParams\Zdr> $zdr `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
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
        UnionMember0|array|UnionMember1|null $parseParams = null,
        ?array $policies = null,
        ProductParams|array|null $productParams = null,
        ScreenshotParams|array|null $screenshotParams = null,
        SharedParams|array|null $sharedParams = null,
        ?array $tags = null,
        \ContextDev\Web\WebScrapeParams\TimeoutOpts|array|null $timeoutOpts = null,
        \ContextDev\Web\WebScrapeParams\Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): WebScrapeResponse;

    /**
     * @api
     *
     * @param bool $clearPopups dismiss cookie banners and close other popups and overlays before capture
     * @param \ContextDev\Web\WebScreenshotParams\ColorScheme|value-of<\ContextDev\Web\WebScreenshotParams\ColorScheme> $colorScheme emulate a light or dark color scheme
     * @param Country|value-of<Country> $country country to fetch from, as an ISO 3166-1 alpha-2 code
     * @param string $directURL Exact URL to capture, such as `https://example.com/pricing`. Provide either `domain` or `directUrl`, not both.
     * @param string $domain Domain to capture, such as `stripe.com`. Provide either `domain` or `directUrl`, not both.
     * @param FullScreenshot|value-of<FullScreenshot> $fullScreenshot capture the full scrollable page instead of only the viewport
     * @param bool $handleCookiePopup dismiss cookie consent banners before capture
     * @param array<string,string> $headers HTTP headers to send to the target origin, such as `headers[Authorization]=Bearer token`. Requests with headers skip the cache and return the image as a data URL.
     * @param int|null $maxAgeMs Maximum age of a cached result, in milliseconds. `0` always fetches fresh. Defaults to 1 day (86400000 ms). Maximum: 30 days (2592000000 ms).
     * @param Page|value-of<Page> $page Capture this type of page instead of the home page. Context.dev finds it among the domain's links, in 30 languages. Only with `domain`.
     * @param int|null $scrollOffset Return the viewport-sized slice of the full page that starts this many pixels from the top. Step by the viewport height, such as `0`, `1080`, `2160`, to walk a long page. The last slice can be shorter. Overrides `fullScreenshot`.
     * @param list<string> $tags Comma-separated labels for this request, such as `production,team-alpha`. Filter usage and request logs by them.
     * @param \ContextDev\Web\WebScreenshotParams\TimeoutOpts|TimeoutOptsShape5 $timeoutOpts request deadline and what to return when it passes
     * @param Viewport|ViewportShape $viewport browser viewport size in pixels
     * @param int|null $waitForMs Time to wait after the page loads before capturing, in milliseconds. `0` waits 500 ms. `timeoutOpts.milliseconds` must be at least `waitForMs` plus 10000 ms, or the request fails with `TIMEOUT_TOO_SHORT_FOR_WAIT`.
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
    ): WebScreenshotResponse;

    /**
     * @api
     *
     * @param string $query Search query. Accepts natural language and search operators such as `site:`, `-site:`, `inurl:`, `intitle:`, quoted phrases, and `OR`.
     * @param \ContextDev\Web\WebSearchParams\Country|value-of<\ContextDev\Web\WebSearchParams\Country> $country localize results to this country, as an ISO 3166-1 alpha-2 code such as `us` or `de`
     * @param int|null $descriptionMaxCharacters maximum length of each result's `description`, in characters
     * @param list<string> $excludeDomains Leave out results from these domains, such as `pinterest.com`.
     * @param Freshness|value-of<Freshness> $freshness restrict results to content published within this window
     * @param HighlightsOptions|HighlightsOptionsShape|null $highlightsOptions Return passages from each result page that are relevant to the query. Pages are read with the `markdownOptions` settings.
     * @param list<string> $includeDomains Only return results from these domains, such as `arxiv.org`.
     * @param LanguagesShape $languages languages to return results in, as BCP 47 codes such as `en` or `de`, or `all` for any language
     * @param MarkdownOptions|MarkdownOptionsShape|null $markdownOptions Scrape each result page to Markdown. Set `enabled` to `true` to turn it on.
     * @param int $numResults number of results to return
     * @param list<string> $policies Access policy IDs to apply; each URL must pass all of them. Requires access policies enabled for your organization; otherwise returns `ACCESS_POLICIES_NOT_ENABLED`.
     * @param list<string> $tags Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
     * @param \ContextDev\Web\WebSearchParams\TimeoutOpts|TimeoutOptsShape6 $timeoutOpts request deadline and what to return when it passes
     * @param \ContextDev\Web\WebSearchParams\Zdr|value-of<\ContextDev\Web\WebSearchParams\Zdr> $zdr `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function search(
        string $query,
        \ContextDev\Web\WebSearchParams\Country|string|null $country = null,
        ?int $descriptionMaxCharacters = null,
        ?array $excludeDomains = null,
        Freshness|string|null $freshness = null,
        HighlightsOptions|array|null $highlightsOptions = null,
        ?array $includeDomains = null,
        \ContextDev\Web\WebSearchParams\Languages\UnionMember0|array|string $languages = 'all',
        MarkdownOptions|array|null $markdownOptions = null,
        int $numResults = 10,
        ?array $policies = null,
        ?array $tags = null,
        \ContextDev\Web\WebSearchParams\TimeoutOpts|array|null $timeoutOpts = null,
        \ContextDev\Web\WebSearchParams\Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): WebSearchResponse;

    /**
     * @api
     *
     * @param string $url start URL, including `http://` or `https://`
     * @param \ContextDev\Web\WebWebCrawlMdParams\Country|value-of<\ContextDev\Web\WebWebCrawlMdParams\Country> $country country to fetch from, as an ISO 3166-1 alpha-2 code
     * @param list<string>|null $excludeSelectors Remove elements matching these CSS selectors. Overrides `includeSelectors`.
     * @param string $excludeURLRegex Never follow or scrape URLs matching this regex, even when they match `urlRegex`. The start URL is always scraped.
     * @param bool $followSubdomains Follow links to subdomains of the start URL's domain, such as `docs.example.com` from `example.com`. `www` and the apex domain always count as the same site.
     * @param IncludeFramesShape $includeFrames Which iframe contents to include in each page's Markdown. `auto` inlines only iframes that hold page content, such as same-site documents, framesets, job boards, forms, and embedded documents, and skips ads and widgets. `true` inlines every iframe; `false` inlines none.
     * @param bool $includeImages include image references in the Markdown (`html-conversion` only)
     * @param bool $includeLinks keep link URLs in the Markdown (`html-conversion` only)
     * @param list<string>|null $includeSelectors keep only elements matching these CSS selectors
     * @param int|null $maxAgeMs Maximum age of a cached result, in milliseconds. `0` always fetches fresh. Defaults to 1 day (86400000 ms). Maximum: 30 days (2592000000 ms).
     * @param int $maxDepth Maximum link depth from the start URL. `0` crawls only the start URL. Omit for no depth limit.
     * @param int $maxPages maximum number of pages to crawl
     * @param Pdf|PdfShape $pdf whether to parse PDFs and which pages to read
     * @param list<string> $policies Access policy IDs to apply; each URL must pass all of them. Requires access policies enabled for your organization; otherwise returns `ACCESS_POLICIES_NOT_ENABLED`.
     * @param bool $settleAnimations wait briefly for CSS animations and transitions to settle before reading each page
     * @param bool $shortenBase64Images shorten inline base64 image data (`html-conversion` only)
     * @param list<SourcePreference|value-of<SourcePreference>> $sourcePreference markdown sources in order of preference: `html-conversion` converts the page HTML, `markdown-direct` uses Markdown the site publishes
     * @param int $stopAfterMs Soft time budget for the crawl, in milliseconds. When it runs out, the crawl returns the pages collected so far. Larger values are capped at 110 seconds.
     * @param list<string> $tags Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
     * @param \ContextDev\Web\WebWebCrawlMdParams\TimeoutOpts|TimeoutOptsShape7 $timeoutOpts request deadline and what to return when it passes
     * @param string $urlRegex Only follow and scrape URLs matching this regex. A prefix pattern of the form `^<start URL>` also follows a redirect of the start page.
     * @param bool $useMainContentOnly keep only the main content, without navigation, headers, footers, or sidebars
     * @param int|null $waitForMs Time to wait after each page loads before reading it, in milliseconds. `0` waits 500 ms. `timeoutOpts.milliseconds` must be at least `waitForMs` plus 10000 ms, or the request fails with `TIMEOUT_TOO_SHORT_FOR_WAIT`.
     * @param \ContextDev\Web\WebWebCrawlMdParams\Zdr|value-of<\ContextDev\Web\WebWebCrawlMdParams\Zdr> $zdr `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function webCrawlMd(
        string $url,
        \ContextDev\Web\WebWebCrawlMdParams\Country|string|null $country = null,
        ?array $excludeSelectors = null,
        ?string $excludeURLRegex = null,
        bool $followSubdomains = false,
        bool|\ContextDev\Web\WebWebCrawlMdParams\IncludeFrames\UnionMember1|string $includeFrames = 'auto',
        bool $includeImages = false,
        bool $includeLinks = true,
        ?array $includeSelectors = null,
        ?int $maxAgeMs = 86400000,
        ?int $maxDepth = null,
        int $maxPages = 100,
        Pdf|array $pdf = ['shouldParse' => true, 'ocr' => false],
        ?array $policies = null,
        bool $settleAnimations = false,
        bool $shortenBase64Images = true,
        array $sourcePreference = ['html-conversion', 'markdown-direct'],
        int $stopAfterMs = 80000,
        ?array $tags = null,
        \ContextDev\Web\WebWebCrawlMdParams\TimeoutOpts|array|null $timeoutOpts = null,
        ?string $urlRegex = null,
        bool $useMainContentOnly = false,
        ?int $waitForMs = 3500,
        \ContextDev\Web\WebWebCrawlMdParams\Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): WebWebCrawlMdResponse;
}
