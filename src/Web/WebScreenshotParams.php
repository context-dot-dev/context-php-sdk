<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScreenshotParams\ColorScheme;
use ContextDev\Web\WebScreenshotParams\Country;
use ContextDev\Web\WebScreenshotParams\FullScreenshot;
use ContextDev\Web\WebScreenshotParams\Page;
use ContextDev\Web\WebScreenshotParams\TimeoutOpts;
use ContextDev\Web\WebScreenshotParams\Viewport;
use ContextDev\Web\WebScreenshotParams\Zdr;

/**
 * Capture a screenshot of a website.
 *
 * @see ContextDev\Services\WebService::screenshot()
 *
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebScreenshotParams\TimeoutOpts
 * @phpstan-import-type ViewportShape from \ContextDev\Web\WebScreenshotParams\Viewport
 *
 * @phpstan-type WebScreenshotParamsShape = array{
 *   clearPopups?: bool|null,
 *   colorScheme?: null|ColorScheme|value-of<ColorScheme>,
 *   country?: null|Country|value-of<Country>,
 *   directURL?: string|null,
 *   domain?: string|null,
 *   fullScreenshot?: null|FullScreenshot|value-of<FullScreenshot>,
 *   handleCookiePopup?: bool|null,
 *   maxAgeMs?: int|null,
 *   page?: null|Page|value-of<Page>,
 *   scrollOffset?: int|null,
 *   tags?: list<string>|null,
 *   timeoutOpts?: null|TimeoutOpts|TimeoutOptsShape,
 *   viewport?: null|Viewport|ViewportShape,
 *   waitForMs?: int|null,
 *   zdr?: null|Zdr|value-of<Zdr>,
 * }
 */
final class WebScreenshotParams implements BaseModel
{
    /** @use SdkModel<WebScreenshotParamsShape> */
    use SdkModel;
    use SdkParams;

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
     * A specific URL to screenshot directly, bypassing domain resolution (e.g., 'https://example.com/pricing'). When provided, the screenshot is taken of this exact URL. You must provide either 'domain' or 'directUrl', but not both.
     */
    #[Optional]
    public ?string $directURL;

    /**
     * Domain name to take screenshot of (e.g., 'example.com', 'google.com'). The domain will be automatically normalized and validated. You must provide either 'domain' or 'directUrl', but not both.
     */
    #[Optional]
    public ?string $domain;

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
     * Return a cached screenshot if a prior screenshot for the same parameters exists and is younger than this many milliseconds. Defaults to 1 day (86400000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always capture fresh.
     */
    #[Optional(nullable: true)]
    public ?int $maxAgeMs;

    /**
     * Optional parameter to specify which page type to screenshot. If provided, the system will scrape the domain's links and use heuristics to find the most appropriate URL for the specified page type (30 supported languages). If not provided, screenshots the main domain landing page. Only applicable when using 'domain', not 'directUrl'.
     *
     * @var value-of<Page>|null $page
     */
    #[Optional(enum: Page::class)]
    public ?string $page;

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
     * @param Page|value-of<Page>|null $page
     * @param list<string>|null $tags
     * @param TimeoutOpts|TimeoutOptsShape|null $timeoutOpts
     * @param Viewport|ViewportShape|null $viewport
     * @param Zdr|value-of<Zdr>|null $zdr
     */
    public static function with(
        ?bool $clearPopups = null,
        ColorScheme|string|null $colorScheme = null,
        Country|string|null $country = null,
        ?string $directURL = null,
        ?string $domain = null,
        FullScreenshot|string|null $fullScreenshot = null,
        ?bool $handleCookiePopup = null,
        ?int $maxAgeMs = null,
        Page|string|null $page = null,
        ?int $scrollOffset = null,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
        Viewport|array|null $viewport = null,
        ?int $waitForMs = null,
        Zdr|string|null $zdr = null,
    ): self {
        $self = new self;

        null !== $clearPopups && $self['clearPopups'] = $clearPopups;
        null !== $colorScheme && $self['colorScheme'] = $colorScheme;
        null !== $country && $self['country'] = $country;
        null !== $directURL && $self['directURL'] = $directURL;
        null !== $domain && $self['domain'] = $domain;
        null !== $fullScreenshot && $self['fullScreenshot'] = $fullScreenshot;
        null !== $handleCookiePopup && $self['handleCookiePopup'] = $handleCookiePopup;
        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
        null !== $page && $self['page'] = $page;
        null !== $scrollOffset && $self['scrollOffset'] = $scrollOffset;
        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutOpts && $self['timeoutOpts'] = $timeoutOpts;
        null !== $viewport && $self['viewport'] = $viewport;
        null !== $waitForMs && $self['waitForMs'] = $waitForMs;
        null !== $zdr && $self['zdr'] = $zdr;

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
     * A specific URL to screenshot directly, bypassing domain resolution (e.g., 'https://example.com/pricing'). When provided, the screenshot is taken of this exact URL. You must provide either 'domain' or 'directUrl', but not both.
     */
    public function withDirectURL(string $directURL): self
    {
        $self = clone $this;
        $self['directURL'] = $directURL;

        return $self;
    }

    /**
     * Domain name to take screenshot of (e.g., 'example.com', 'google.com'). The domain will be automatically normalized and validated. You must provide either 'domain' or 'directUrl', but not both.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

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
     * Return a cached screenshot if a prior screenshot for the same parameters exists and is younger than this many milliseconds. Defaults to 1 day (86400000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always capture fresh.
     */
    public function withMaxAgeMs(?int $maxAgeMs): self
    {
        $self = clone $this;
        $self['maxAgeMs'] = $maxAgeMs;

        return $self;
    }

    /**
     * Optional parameter to specify which page type to screenshot. If provided, the system will scrape the domain's links and use heuristics to find the most appropriate URL for the specified page type (30 supported languages). If not provided, screenshots the main domain landing page. Only applicable when using 'domain', not 'directUrl'.
     *
     * @param Page|value-of<Page> $page
     */
    public function withPage(Page|string $page): self
    {
        $self = clone $this;
        $self['page'] = $page;

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
