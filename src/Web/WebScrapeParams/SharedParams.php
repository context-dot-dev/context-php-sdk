<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScrapeParams\SharedParams\Action;
use ContextDev\Web\WebScrapeParams\SharedParams\Parsers;
use ContextDev\Web\WebScrapeParams\SharedParams\Theme;
use ContextDev\Web\WebScrapeParams\SharedParams\Viewport;

/**
 * Shared browser and content settings. Content filters leave screenshots and original bytes unchanged.
 *
 * @phpstan-import-type ActionVariants from \ContextDev\Web\WebScrapeParams\SharedParams\Action
 * @phpstan-import-type WaitForVariants from \ContextDev\Web\WebScrapeParams\SharedParams\WaitFor
 * @phpstan-import-type ActionShape from \ContextDev\Web\WebScrapeParams\SharedParams\Action
 * @phpstan-import-type ParsersShape from \ContextDev\Web\WebScrapeParams\SharedParams\Parsers
 * @phpstan-import-type ViewportShape from \ContextDev\Web\WebScrapeParams\SharedParams\Viewport
 * @phpstan-import-type WaitForShape from \ContextDev\Web\WebScrapeParams\SharedParams\WaitFor
 *
 * @phpstan-type SharedParamsShape = array{
 *   actions?: list<ActionShape>|null,
 *   country?: string|null,
 *   dismissCookies?: bool|null,
 *   dismissPopups?: bool|null,
 *   excludeSelectors?: list<string>|null,
 *   headers?: array<string,string>|null,
 *   includeFrames?: bool|null,
 *   includeSelectors?: list<string>|null,
 *   mainContentOnly?: bool|null,
 *   parsers?: null|Parsers|ParsersShape,
 *   settleAnimations?: bool|null,
 *   theme?: null|Theme|value-of<Theme>,
 *   viewport?: null|Viewport|ViewportShape,
 *   waitFor?: WaitForShape|null,
 * }
 */
final class SharedParams implements BaseModel
{
    /** @use SdkModel<SharedParamsShape> */
    use SdkModel;

    /**
     * Run in order before capture. A failed action fails the request. Bypasses caching.
     *
     * @var list<ActionVariants>|null $actions
     */
    #[Optional(list: Action::class)]
    public ?array $actions;

    /**
     * Supported two-letter country code, case-insensitive. Applies to every output, including image downloads.
     */
    #[Optional]
    public ?string $country;

    /**
     * Dismiss cookie banners by accepting cookies before actions.
     */
    #[Optional]
    public ?bool $dismissCookies;

    /**
     * Dismiss other popups before actions.
     */
    #[Optional]
    public ?bool $dismissPopups;

    /**
     * Remove matching content. Exclusions win.
     *
     * @var list<string>|null $excludeSelectors
     */
    #[Optional(list: 'string')]
    public ?array $excludeSelectors;

    /**
     * Headers for the target origin. Requests with custom headers bypass caching.
     *
     * @var array<string,string>|null $headers
     */
    #[Optional(map: 'string')]
    public ?array $headers;

    /**
     * Include iframe content in extraction. Screenshots show visible frames regardless.
     */
    #[Optional]
    public ?bool $includeFrames;

    /**
     * Keep matching content after mainContentOnly.
     *
     * @var list<string>|null $includeSelectors
     */
    #[Optional(list: 'string')]
    public ?array $includeSelectors;

    /**
     * Keep only main content in HTML, Markdown, images, and parsed fields.
     */
    #[Optional]
    public ?bool $mainContentOnly;

    /**
     * Document parsing options.
     */
    #[Optional]
    public ?Parsers $parsers;

    /**
     * Settle animations before capture. Defaults to true with screenshots, otherwise false.
     */
    #[Optional]
    public ?bool $settleAnimations;

    /**
     * Override the browser color scheme.
     *
     * @var value-of<Theme>|null $theme
     */
    #[Optional(enum: Theme::class)]
    public ?string $theme;

    /**
     * Browser dimensions in pixels.
     */
    #[Optional]
    public ?Viewport $viewport;

    /**
     * After actions, wait this many milliseconds or until a CSS selector is visible. Defaults to 500 ms, or 2000 ms with frames or an XML URL. Set 0 to skip.
     *
     * @var WaitForVariants|null $waitFor
     */
    #[Optional]
    public int|string|null $waitFor;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<ActionShape>|null $actions
     * @param list<string>|null $excludeSelectors
     * @param array<string,string>|null $headers
     * @param list<string>|null $includeSelectors
     * @param Parsers|ParsersShape|null $parsers
     * @param Theme|value-of<Theme>|null $theme
     * @param Viewport|ViewportShape|null $viewport
     * @param WaitForShape|null $waitFor
     */
    public static function with(
        ?array $actions = null,
        ?string $country = null,
        ?bool $dismissCookies = null,
        ?bool $dismissPopups = null,
        ?array $excludeSelectors = null,
        ?array $headers = null,
        ?bool $includeFrames = null,
        ?array $includeSelectors = null,
        ?bool $mainContentOnly = null,
        Parsers|array|null $parsers = null,
        ?bool $settleAnimations = null,
        Theme|string|null $theme = null,
        Viewport|array|null $viewport = null,
        int|string|null $waitFor = null,
    ): self {
        $self = new self;

        null !== $actions && $self['actions'] = $actions;
        null !== $country && $self['country'] = $country;
        null !== $dismissCookies && $self['dismissCookies'] = $dismissCookies;
        null !== $dismissPopups && $self['dismissPopups'] = $dismissPopups;
        null !== $excludeSelectors && $self['excludeSelectors'] = $excludeSelectors;
        null !== $headers && $self['headers'] = $headers;
        null !== $includeFrames && $self['includeFrames'] = $includeFrames;
        null !== $includeSelectors && $self['includeSelectors'] = $includeSelectors;
        null !== $mainContentOnly && $self['mainContentOnly'] = $mainContentOnly;
        null !== $parsers && $self['parsers'] = $parsers;
        null !== $settleAnimations && $self['settleAnimations'] = $settleAnimations;
        null !== $theme && $self['theme'] = $theme;
        null !== $viewport && $self['viewport'] = $viewport;
        null !== $waitFor && $self['waitFor'] = $waitFor;

        return $self;
    }

    /**
     * Run in order before capture. A failed action fails the request. Bypasses caching.
     *
     * @param list<ActionShape> $actions
     */
    public function withActions(array $actions): self
    {
        $self = clone $this;
        $self['actions'] = $actions;

        return $self;
    }

    /**
     * Supported two-letter country code, case-insensitive. Applies to every output, including image downloads.
     */
    public function withCountry(string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * Dismiss cookie banners by accepting cookies before actions.
     */
    public function withDismissCookies(bool $dismissCookies): self
    {
        $self = clone $this;
        $self['dismissCookies'] = $dismissCookies;

        return $self;
    }

    /**
     * Dismiss other popups before actions.
     */
    public function withDismissPopups(bool $dismissPopups): self
    {
        $self = clone $this;
        $self['dismissPopups'] = $dismissPopups;

        return $self;
    }

    /**
     * Remove matching content. Exclusions win.
     *
     * @param list<string> $excludeSelectors
     */
    public function withExcludeSelectors(array $excludeSelectors): self
    {
        $self = clone $this;
        $self['excludeSelectors'] = $excludeSelectors;

        return $self;
    }

    /**
     * Headers for the target origin. Requests with custom headers bypass caching.
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
     * Include iframe content in extraction. Screenshots show visible frames regardless.
     */
    public function withIncludeFrames(bool $includeFrames): self
    {
        $self = clone $this;
        $self['includeFrames'] = $includeFrames;

        return $self;
    }

    /**
     * Keep matching content after mainContentOnly.
     *
     * @param list<string> $includeSelectors
     */
    public function withIncludeSelectors(array $includeSelectors): self
    {
        $self = clone $this;
        $self['includeSelectors'] = $includeSelectors;

        return $self;
    }

    /**
     * Keep only main content in HTML, Markdown, images, and parsed fields.
     */
    public function withMainContentOnly(bool $mainContentOnly): self
    {
        $self = clone $this;
        $self['mainContentOnly'] = $mainContentOnly;

        return $self;
    }

    /**
     * Document parsing options.
     *
     * @param Parsers|ParsersShape $parsers
     */
    public function withParsers(Parsers|array $parsers): self
    {
        $self = clone $this;
        $self['parsers'] = $parsers;

        return $self;
    }

    /**
     * Settle animations before capture. Defaults to true with screenshots, otherwise false.
     */
    public function withSettleAnimations(bool $settleAnimations): self
    {
        $self = clone $this;
        $self['settleAnimations'] = $settleAnimations;

        return $self;
    }

    /**
     * Override the browser color scheme.
     *
     * @param Theme|value-of<Theme> $theme
     */
    public function withTheme(Theme|string $theme): self
    {
        $self = clone $this;
        $self['theme'] = $theme;

        return $self;
    }

    /**
     * Browser dimensions in pixels.
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
     * After actions, wait this many milliseconds or until a CSS selector is visible. Defaults to 500 ms, or 2000 ms with frames or an XML URL. Set 0 to skip.
     *
     * @param WaitForShape $waitFor
     */
    public function withWaitFor(int|string $waitFor): self
    {
        $self = clone $this;
        $self['waitFor'] = $waitFor;

        return $self;
    }
}
