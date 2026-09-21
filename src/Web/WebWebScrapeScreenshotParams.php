<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebScrapeScreenshotParams\ColorScheme;
use ContextDev\Web\WebWebScrapeScreenshotParams\Country;
use ContextDev\Web\WebWebScrapeScreenshotParams\FullScreenshot;
use ContextDev\Web\WebWebScrapeScreenshotParams\TimeoutOpts;
use ContextDev\Web\WebWebScrapeScreenshotParams\Viewport;
use ContextDev\Web\WebWebScrapeScreenshotParams\Zdr;

/**
 * Capture the given HTTP or HTTPS URL with configurable viewport, full-page capture, wait time, popup handling, theme, scroll offset, cache age, country, and request timeout. Defaults to a 1920x1080 viewport, a 3-second wait, and a cache age of 1 day. With timeoutOpts.behavior=return-partial, a screenshot of the page rendered so far may be returned; inspect finalDOMState to identify an incomplete render. Successful requests cost 1 credit; errors are not billed.
 *
 * @see ContextDev\Services\WebService::webScrapeScreenshot()
 *
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebWebScrapeScreenshotParams\TimeoutOpts
 * @phpstan-import-type ViewportShape from \ContextDev\Web\WebWebScrapeScreenshotParams\Viewport
 *
 * @phpstan-type WebWebScrapeScreenshotParamsShape = array{
 *   url: string,
 *   clearPopups?: bool|null,
 *   colorScheme?: null|ColorScheme|value-of<ColorScheme>,
 *   country?: null|Country|value-of<Country>,
 *   fullScreenshot?: null|FullScreenshot|value-of<FullScreenshot>,
 *   handleCookiePopup?: bool|null,
 *   headers?: array<string,string>|null,
 *   maxAgeMs?: int|null,
 *   scrollOffset?: int|null,
 *   tags?: list<string>|null,
 *   timeoutOpts?: null|TimeoutOpts|TimeoutOptsShape,
 *   viewport?: null|Viewport|ViewportShape,
 *   waitForMs?: int|null,
 *   zdr?: null|Zdr|value-of<Zdr>,
 * }
 */
final class WebWebScrapeScreenshotParams implements BaseModel
{
    /** @use SdkModel<WebWebScrapeScreenshotParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $url;

    /**
     * Optional parameter for comprehensive popup cleanup. If 'true', the browser dismisses detected cookie/consent UI and clears other detected obstructive popups and overlays before capture. If 'false' or not provided, this parameter requests no cleanup; handleCookiePopup can still request cookie/consent handling independently.
     */
    #[Optional]
    public ?bool $clearPopups;

    /**
     * Optional parameter to choose the site's visual theme in the screenshot. Use 'light' or 'dark' when the site offers both appearances.
     *
     * @var value-of<ColorScheme>|null $colorScheme
     */
    #[Optional(enum: ColorScheme::class)]
    public ?string $colorScheme;

    /**
     * Fetch the target page through a residential proxy in this country (ISO 3166-1 alpha-2).
     *
     * @var value-of<Country>|null $country
     */
    #[Optional(enum: Country::class)]
    public ?string $country;

    /**
     * Optional parameter to determine screenshot type. If 'true', takes a full page screenshot capturing all content. If 'false' or not provided, takes a viewport screenshot (standard browser view).
     *
     * @var value-of<FullScreenshot>|null $fullScreenshot
     */
    #[Optional(enum: FullScreenshot::class)]
    public ?string $fullScreenshot;

    /**
     * Optional parameter to control cookie/consent popup handling. If 'true', we dismiss cookie banner before capture. If 'false' or not provided, captures the page without that step.
     */
    #[Optional]
    public ?bool $handleCookiePopup;

    /**
     * Optional outbound HTTP headers, using the same JSON object or deep-object query format as other scrape endpoints (for example headers[Authorization]=Bearer token). Headers are scoped to the target origin during capture. For domain/page requests, discovery receives no custom headers and only pages on the resolved origin are eligible. Non-empty headers bypass screenshot caching and return an in-memory data URL; no screenshot is uploaded. Empty objects behave like omitted headers.
     *
     * @var array<string,string>|null $headers
     */
    #[Optional(map: 'string')]
    public ?array $headers;

    /**
     * Return a cached screenshot if a prior screenshot for the same parameters exists and is younger than this many milliseconds. Defaults to 1 day (86400000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always capture fresh.
     */
    #[Optional(nullable: true)]
    public ?int $maxAgeMs;

    /**
     * Optional vertical scroll offset in pixels for capturing a long page in viewport-sized chunks. When provided, the full page is captured once and the returned image is the viewport-sized slice that begins at this Y offset (e.g. request scrollOffset=0, then 1080, then 2160 to walk a 1920x1080 landing page top to bottom). The final slice may be shorter than the viewport height. Takes precedence over fullScreenshot. Max: 100000.
     */
    #[Optional(nullable: true)]
    public ?int $scrollOffset;

    /**
     * Comma-separated tags for tracking request usage. Up to 20 tags, each 1-50 characters.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     */
    #[Optional]
    public ?TimeoutOpts $timeoutOpts;

    /**
     * Optional browser viewport dimensions for the screenshot. Defaults to 1920x1080.
     */
    #[Optional]
    public ?Viewport $viewport;

    /**
     * Optional browser wait time in milliseconds after initial page load before taking the screenshot. Min: 0. Max: 30000 (30 seconds). Defaults to 3000 ms when omitted. When combined with timeoutOpts, timeoutOpts.milliseconds must be at least waitForMs + 10000 ms; a shorter deadline is rejected with 400 TIMEOUT_TOO_SHORT_FOR_WAIT.
     */
    #[Optional(nullable: true)]
    public ?int $waitForMs;

    /**
     * Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Asset uploads are skipped, so hosted image URLs are omitted. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
     *
     * @var value-of<Zdr>|null $zdr
     */
    #[Optional(enum: Zdr::class)]
    public ?string $zdr;

    /**
     * `new WebWebScrapeScreenshotParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebWebScrapeScreenshotParams::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebWebScrapeScreenshotParams)->withURL(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param ColorScheme|value-of<ColorScheme>|null $colorScheme
     * @param Country|value-of<Country>|null $country
     * @param FullScreenshot|value-of<FullScreenshot>|null $fullScreenshot
     * @param array<string,string>|null $headers
     * @param list<string>|null $tags
     * @param TimeoutOpts|TimeoutOptsShape|null $timeoutOpts
     * @param Viewport|ViewportShape|null $viewport
     * @param Zdr|value-of<Zdr>|null $zdr
     */
    public static function with(
        string $url,
        ?bool $clearPopups = null,
        ColorScheme|string|null $colorScheme = null,
        Country|string|null $country = null,
        FullScreenshot|string|null $fullScreenshot = null,
        ?bool $handleCookiePopup = null,
        ?array $headers = null,
        ?int $maxAgeMs = null,
        ?int $scrollOffset = null,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
        Viewport|array|null $viewport = null,
        ?int $waitForMs = null,
        Zdr|string|null $zdr = null,
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $clearPopups && $self['clearPopups'] = $clearPopups;
        null !== $colorScheme && $self['colorScheme'] = $colorScheme;
        null !== $country && $self['country'] = $country;
        null !== $fullScreenshot && $self['fullScreenshot'] = $fullScreenshot;
        null !== $handleCookiePopup && $self['handleCookiePopup'] = $handleCookiePopup;
        null !== $headers && $self['headers'] = $headers;
        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
        null !== $scrollOffset && $self['scrollOffset'] = $scrollOffset;
        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutOpts && $self['timeoutOpts'] = $timeoutOpts;
        null !== $viewport && $self['viewport'] = $viewport;
        null !== $waitForMs && $self['waitForMs'] = $waitForMs;
        null !== $zdr && $self['zdr'] = $zdr;

        return $self;
    }

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Optional parameter for comprehensive popup cleanup. If 'true', the browser dismisses detected cookie/consent UI and clears other detected obstructive popups and overlays before capture. If 'false' or not provided, this parameter requests no cleanup; handleCookiePopup can still request cookie/consent handling independently.
     */
    public function withClearPopups(bool $clearPopups): self
    {
        $self = clone $this;
        $self['clearPopups'] = $clearPopups;

        return $self;
    }

    /**
     * Optional parameter to choose the site's visual theme in the screenshot. Use 'light' or 'dark' when the site offers both appearances.
     *
     * @param ColorScheme|value-of<ColorScheme> $colorScheme
     */
    public function withColorScheme(ColorScheme|string $colorScheme): self
    {
        $self = clone $this;
        $self['colorScheme'] = $colorScheme;

        return $self;
    }

    /**
     * Fetch the target page through a residential proxy in this country (ISO 3166-1 alpha-2).
     *
     * @param Country|value-of<Country> $country
     */
    public function withCountry(Country|string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * Optional parameter to determine screenshot type. If 'true', takes a full page screenshot capturing all content. If 'false' or not provided, takes a viewport screenshot (standard browser view).
     *
     * @param FullScreenshot|value-of<FullScreenshot> $fullScreenshot
     */
    public function withFullScreenshot(
        FullScreenshot|string $fullScreenshot
    ): self {
        $self = clone $this;
        $self['fullScreenshot'] = $fullScreenshot;

        return $self;
    }

    /**
     * Optional parameter to control cookie/consent popup handling. If 'true', we dismiss cookie banner before capture. If 'false' or not provided, captures the page without that step.
     */
    public function withHandleCookiePopup(bool $handleCookiePopup): self
    {
        $self = clone $this;
        $self['handleCookiePopup'] = $handleCookiePopup;

        return $self;
    }

    /**
     * Optional outbound HTTP headers, using the same JSON object or deep-object query format as other scrape endpoints (for example headers[Authorization]=Bearer token). Headers are scoped to the target origin during capture. For domain/page requests, discovery receives no custom headers and only pages on the resolved origin are eligible. Non-empty headers bypass screenshot caching and return an in-memory data URL; no screenshot is uploaded. Empty objects behave like omitted headers.
     *
     * @param array<string,string> $headers
     */
    public function withHeaders(array $headers): self
    {
        $self = clone $this;
        $self['headers'] = $headers;

        return $self;
    }

    /**
     * Return a cached screenshot if a prior screenshot for the same parameters exists and is younger than this many milliseconds. Defaults to 1 day (86400000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always capture fresh.
     */
    public function withMaxAgeMs(?int $maxAgeMs): self
    {
        $self = clone $this;
        $self['maxAgeMs'] = $maxAgeMs;

        return $self;
    }

    /**
     * Optional vertical scroll offset in pixels for capturing a long page in viewport-sized chunks. When provided, the full page is captured once and the returned image is the viewport-sized slice that begins at this Y offset (e.g. request scrollOffset=0, then 1080, then 2160 to walk a 1920x1080 landing page top to bottom). The final slice may be shorter than the viewport height. Takes precedence over fullScreenshot. Max: 100000.
     */
    public function withScrollOffset(?int $scrollOffset): self
    {
        $self = clone $this;
        $self['scrollOffset'] = $scrollOffset;

        return $self;
    }

    /**
     * Comma-separated tags for tracking request usage. Up to 20 tags, each 1-50 characters.
     *
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     *
     * @param TimeoutOpts|TimeoutOptsShape $timeoutOpts
     */
    public function withTimeoutOpts(TimeoutOpts|array $timeoutOpts): self
    {
        $self = clone $this;
        $self['timeoutOpts'] = $timeoutOpts;

        return $self;
    }

    /**
     * Optional browser viewport dimensions for the screenshot. Defaults to 1920x1080.
     *
     * @param Viewport|ViewportShape $viewport
     */
    public function withViewport(Viewport|array $viewport): self
    {
        $self = clone $this;
        $self['viewport'] = $viewport;

        return $self;
    }

    /**
     * Optional browser wait time in milliseconds after initial page load before taking the screenshot. Min: 0. Max: 30000 (30 seconds). Defaults to 3000 ms when omitted. When combined with timeoutOpts, timeoutOpts.milliseconds must be at least waitForMs + 10000 ms; a shorter deadline is rejected with 400 TIMEOUT_TOO_SHORT_FOR_WAIT.
     */
    public function withWaitForMs(?int $waitForMs): self
    {
        $self = clone $this;
        $self['waitForMs'] = $waitForMs;

        return $self;
    }

    /**
     * Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Asset uploads are skipped, so hosted image URLs are omitted. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
     *
     * @param Zdr|value-of<Zdr> $zdr
     */
    public function withZdr(Zdr|string $zdr): self
    {
        $self = clone $this;
        $self['zdr'] = $zdr;

        return $self;
    }
}
