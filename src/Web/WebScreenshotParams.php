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
 * Capture a screenshot of a website's home page, a page type such as pricing, or an exact URL. Returns the visible viewport, a scroll slice, or the full page.
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
 *   headers?: array<string,string>|null,
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
     * Dismiss cookie banners and close other popups and overlays before capture.
     */
    #[Optional]
    public ?bool $clearPopups;

    /**
     * Emulate a light or dark color scheme.
     *
     * @var value-of<ColorScheme>|null $colorScheme
     */
    #[Optional(enum: ColorScheme::class)]
    public ?string $colorScheme;

    /**
     * Country to fetch from, as an ISO 3166-1 alpha-2 code.
     *
     * @var value-of<Country>|null $country
     */
    #[Optional(enum: Country::class)]
    public ?string $country;

    /**
     * Exact URL to capture, such as `https://example.com/pricing`. Provide either `domain` or `directUrl`, not both.
     */
    #[Optional]
    public ?string $directURL;

    /**
     * Domain to capture, such as `stripe.com`. Provide either `domain` or `directUrl`, not both.
     */
    #[Optional]
    public ?string $domain;

    /**
     * Capture the full scrollable page instead of only the viewport.
     *
     * @var value-of<FullScreenshot>|null $fullScreenshot
     */
    #[Optional(enum: FullScreenshot::class)]
    public ?string $fullScreenshot;

    /**
     * Dismiss cookie consent banners before capture.
     */
    #[Optional]
    public ?bool $handleCookiePopup;

    /**
     * HTTP headers to send to the target origin, such as `headers[Authorization]=Bearer token`. Requests with headers skip the cache and return the image as a data URL.
     *
     * @var array<string,string>|null $headers
     */
    #[Optional(map: 'string')]
    public ?array $headers;

    /**
     * Maximum age of a cached result, in milliseconds. `0` always fetches fresh. Defaults to 1 day (86400000 ms). Maximum: 30 days (2592000000 ms).
     */
    #[Optional(nullable: true)]
    public ?int $maxAgeMs;

    /**
     * Capture this type of page instead of the home page. Context.dev finds it among the domain's links, in 30 languages. Only with `domain`.
     *
     * @var value-of<Page>|null $page
     */
    #[Optional(enum: Page::class)]
    public ?string $page;

    /**
     * Return the viewport-sized slice of the full page that starts this many pixels from the top. Step by the viewport height, such as `0`, `1080`, `2160`, to walk a long page. The last slice can be shorter. Overrides `fullScreenshot`.
     */
    #[Optional(nullable: true)]
    public ?int $scrollOffset;

    /**
     * Comma-separated labels for this request, such as `production,team-alpha`. Filter usage and request logs by them.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Request deadline and what to return when it passes.
     */
    #[Optional]
    public ?TimeoutOpts $timeoutOpts;

    /**
     * Browser viewport size in pixels.
     */
    #[Optional]
    public ?Viewport $viewport;

    /**
     * Time to wait after the page loads before capturing, in milliseconds. `0` waits 500 ms. `timeoutOpts.milliseconds` must be at least `waitForMs` plus 10000 ms, or the request fails with `TIMEOUT_TOO_SHORT_FOR_WAIT`.
     */
    #[Optional(nullable: true)]
    public ?int $waitForMs;

    /**
     * `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
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
     * @param array<string,string>|null $headers
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
        ?array $headers = null,
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
        null !== $headers && $self['headers'] = $headers;
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
     * Dismiss cookie banners and close other popups and overlays before capture.
     */
    public function withClearPopups(bool $clearPopups): self
    {
        $self = clone $this;
        $self['clearPopups'] = $clearPopups;

        return $self;
    }

    /**
     * Emulate a light or dark color scheme.
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
     * Country to fetch from, as an ISO 3166-1 alpha-2 code.
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
     * Exact URL to capture, such as `https://example.com/pricing`. Provide either `domain` or `directUrl`, not both.
     */
    public function withDirectURL(string $directURL): self
    {
        $self = clone $this;
        $self['directURL'] = $directURL;

        return $self;
    }

    /**
     * Domain to capture, such as `stripe.com`. Provide either `domain` or `directUrl`, not both.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Capture the full scrollable page instead of only the viewport.
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
     * Dismiss cookie consent banners before capture.
     */
    public function withHandleCookiePopup(bool $handleCookiePopup): self
    {
        $self = clone $this;
        $self['handleCookiePopup'] = $handleCookiePopup;

        return $self;
    }

    /**
     * HTTP headers to send to the target origin, such as `headers[Authorization]=Bearer token`. Requests with headers skip the cache and return the image as a data URL.
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
     * Maximum age of a cached result, in milliseconds. `0` always fetches fresh. Defaults to 1 day (86400000 ms). Maximum: 30 days (2592000000 ms).
     */
    public function withMaxAgeMs(?int $maxAgeMs): self
    {
        $self = clone $this;
        $self['maxAgeMs'] = $maxAgeMs;

        return $self;
    }

    /**
     * Capture this type of page instead of the home page. Context.dev finds it among the domain's links, in 30 languages. Only with `domain`.
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
     * Return the viewport-sized slice of the full page that starts this many pixels from the top. Step by the viewport height, such as `0`, `1080`, `2160`, to walk a long page. The last slice can be shorter. Overrides `fullScreenshot`.
     */
    public function withScrollOffset(?int $scrollOffset): self
    {
        $self = clone $this;
        $self['scrollOffset'] = $scrollOffset;

        return $self;
    }

    /**
     * Comma-separated labels for this request, such as `production,team-alpha`. Filter usage and request logs by them.
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
     * Request deadline and what to return when it passes.
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
     * Browser viewport size in pixels.
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
     * Time to wait after the page loads before capturing, in milliseconds. `0` waits 500 ms. `timeoutOpts.milliseconds` must be at least `waitForMs` plus 10000 ms, or the request fails with `TIMEOUT_TOO_SHORT_FOR_WAIT`.
     */
    public function withWaitForMs(?int $waitForMs): self
    {
        $self = clone $this;
        $self['waitForMs'] = $waitForMs;

        return $self;
    }

    /**
     * `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
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
