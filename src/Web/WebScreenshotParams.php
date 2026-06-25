<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScreenshotParams\FullScreenshot;
use ContextDev\Web\WebScreenshotParams\HandleCookiePopup;
use ContextDev\Web\WebScreenshotParams\Page;
use ContextDev\Web\WebScreenshotParams\Viewport;

/**
 * Capture a screenshot of a website.
 *
 * @see ContextDev\Services\WebService::screenshot()
 *
 * @phpstan-import-type ViewportShape from \ContextDev\Web\WebScreenshotParams\Viewport
 *
 * @phpstan-type WebScreenshotParamsShape = array{
 *   directURL?: string|null,
 *   domain?: string|null,
 *   fullScreenshot?: null|FullScreenshot|value-of<FullScreenshot>,
 *   handleCookiePopup?: null|HandleCookiePopup|value-of<HandleCookiePopup>,
 *   maxAgeMs?: int|null,
 *   page?: null|Page|value-of<Page>,
 *   scrollOffset?: int|null,
 *   timeoutMs?: int|null,
 *   viewport?: null|Viewport|ViewportShape,
 *   waitForMs?: int|null,
 * }
 */
final class WebScreenshotParams implements BaseModel
{
    /** @use SdkModel<WebScreenshotParamsShape> */
    use SdkModel;
    use SdkParams;

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
     *
     * @var value-of<HandleCookiePopup>|null $handleCookiePopup
     */
    #[Optional(enum: HandleCookiePopup::class)]
    public ?string $handleCookiePopup;

    /**
     * Return a cached screenshot if a prior screenshot for the same parameters exists and is younger than this many milliseconds. Defaults to 1 day (86400000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always capture fresh.
     */
    #[Optional]
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
    #[Optional]
    public ?int $scrollOffset;

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    #[Optional]
    public ?int $timeoutMs;

    /**
     * Optional browser viewport dimensions for the screenshot. Defaults to 1920x1080.
     */
    #[Optional]
    public ?Viewport $viewport;

    /**
     * Optional browser wait time in milliseconds after initial page load before taking the screenshot. Min: 0. Max: 30000 (30 seconds).  Defaults to 3000 ms when omitted.
     */
    #[Optional]
    public ?int $waitForMs;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param FullScreenshot|value-of<FullScreenshot>|null $fullScreenshot
     * @param HandleCookiePopup|value-of<HandleCookiePopup>|null $handleCookiePopup
     * @param Page|value-of<Page>|null $page
     * @param Viewport|ViewportShape|null $viewport
     */
    public static function with(
        ?string $directURL = null,
        ?string $domain = null,
        FullScreenshot|string|null $fullScreenshot = null,
        HandleCookiePopup|string|null $handleCookiePopup = null,
        ?int $maxAgeMs = null,
        Page|string|null $page = null,
        ?int $scrollOffset = null,
        ?int $timeoutMs = null,
        Viewport|array|null $viewport = null,
        ?int $waitForMs = null,
    ): self {
        $self = new self;

        null !== $directURL && $self['directURL'] = $directURL;
        null !== $domain && $self['domain'] = $domain;
        null !== $fullScreenshot && $self['fullScreenshot'] = $fullScreenshot;
        null !== $handleCookiePopup && $self['handleCookiePopup'] = $handleCookiePopup;
        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
        null !== $page && $self['page'] = $page;
        null !== $scrollOffset && $self['scrollOffset'] = $scrollOffset;
        null !== $timeoutMs && $self['timeoutMs'] = $timeoutMs;
        null !== $viewport && $self['viewport'] = $viewport;
        null !== $waitForMs && $self['waitForMs'] = $waitForMs;

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
     *
     * @param HandleCookiePopup|value-of<HandleCookiePopup> $handleCookiePopup
     */
    public function withHandleCookiePopup(
        HandleCookiePopup|string $handleCookiePopup
    ): self {
        $self = clone $this;
        $self['handleCookiePopup'] = $handleCookiePopup;

        return $self;
    }

    /**
     * Return a cached screenshot if a prior screenshot for the same parameters exists and is younger than this many milliseconds. Defaults to 1 day (86400000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always capture fresh.
     */
    public function withMaxAgeMs(int $maxAgeMs): self
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
    public function withScrollOffset(int $scrollOffset): self
    {
        $self = clone $this;
        $self['scrollOffset'] = $scrollOffset;

        return $self;
    }

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    public function withTimeoutMs(int $timeoutMs): self
    {
        $self = clone $this;
        $self['timeoutMs'] = $timeoutMs;

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
     * Optional browser wait time in milliseconds after initial page load before taking the screenshot. Min: 0. Max: 30000 (30 seconds).  Defaults to 3000 ms when omitted.
     */
    public function withWaitForMs(int $waitForMs): self
    {
        $self = clone $this;
        $self['waitForMs'] = $waitForMs;

        return $self;
    }
}
