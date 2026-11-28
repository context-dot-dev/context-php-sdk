<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data;

use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\Action;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\IncludeFrames;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\IncludeFrames\UnionMember1;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\Parsers;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\Profile;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\Profile\Existing;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\Profile\New_;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\Theme;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\Viewport;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Browser and content settings shared by all outputs.
 *
 * @phpstan-import-type ActionVariants from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\Action
 * @phpstan-import-type IncludeFramesVariants from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\IncludeFrames
 * @phpstan-import-type ProfileVariants from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\Profile
 * @phpstan-import-type WaitForVariants from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\WaitFor
 * @phpstan-import-type ActionShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\Action
 * @phpstan-import-type IncludeFramesShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\IncludeFrames
 * @phpstan-import-type ParsersShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\Parsers
 * @phpstan-import-type ProfileShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\Profile
 * @phpstan-import-type ViewportShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\Viewport
 * @phpstan-import-type WaitForShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\WaitFor
 *
 * @phpstan-type SharedParamsShape = array{
 *   actions?: list<ActionShape>|null,
 *   country?: string|null,
 *   dismissCookies?: bool|null,
 *   dismissPopups?: bool|null,
 *   excludeSelectors?: list<string>|null,
 *   headers?: array<string,string>|null,
 *   includeFrames?: IncludeFramesShape|null,
 *   includeSelectors?: list<string>|null,
 *   mainContentOnly?: bool|null,
 *   parsers?: null|Parsers|ParsersShape,
 *   profile?: ProfileShape|null,
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
     * Browser steps to run in order before capture. Requires a paid plan. Skips the cache.
     *
     * @var list<ActionVariants>|null $actions
     */
    #[Optional(list: Action::class)]
    public ?array $actions;

    /**
     * Country to fetch from, as an ISO 3166-1 alpha-2 code such as `US`. Case-insensitive.
     */
    #[Optional]
    public ?string $country;

    /**
     * Accept cookie banners before actions and capture.
     */
    #[Optional]
    public ?bool $dismissCookies;

    /**
     * Close other popups before actions and capture.
     */
    #[Optional]
    public ?bool $dismissPopups;

    /**
     * Remove elements matching these CSS selectors. Overrides `includeSelectors`.
     *
     * @var list<string>|null $excludeSelectors
     */
    #[Optional(list: 'string')]
    public ?array $excludeSelectors;

    /**
     * HTTP headers to send to the target site. Requests with headers skip the cache.
     *
     * @var array<string,string>|null $headers
     */
    #[Optional(map: 'string')]
    public ?array $headers;

    /**
     * Which iframes to inline in HTML and text outputs. Screenshots always show visible frames. `auto` inlines only iframes that hold page content, such as same-site documents, framesets, job boards, forms, and embedded documents, and skips ads and widgets. `true` inlines every iframe; `false` inlines none.
     *
     * @var IncludeFramesVariants|null $includeFrames
     */
    #[Optional(union: IncludeFrames::class)]
    public bool|string|null $includeFrames;

    /**
     * Keep only elements matching these CSS selectors.
     *
     * @var list<string>|null $includeSelectors
     */
    #[Optional(list: 'string')]
    public ?array $includeSelectors;

    /**
     * Keep only the main content, without navigation, headers, footers, or sidebars. Does not affect `screenshot`, `bytes`, or `product`.
     */
    #[Optional]
    public ?bool $mainContentOnly;

    /**
     * Options for parsing documents such as PDFs.
     */
    #[Optional]
    public ?Parsers $parsers;

    /**
     * Scrape as a signed-in user. Create a profile with `type: "new"` and your credentials, then reuse it with `type: "existing"`. Requires a paid plan and an HTTPS URL. Profiles keep their session between requests, skip the cache, and cannot be combined with ZDR, custom headers, `formats.bytes`, or prebuilt parsers other than `emails`, `phone-numbers`, and `links`.
     *
     * @var ProfileVariants|null $profile
     */
    #[Optional(union: Profile::class)]
    public Existing|New_|null $profile;

    /**
     * Wait for CSS animations to finish before capture. Defaults to `true` when `formats.screenshot` is `true`.
     */
    #[Optional]
    public ?bool $settleAnimations;

    /**
     * Emulate a light or dark color scheme.
     *
     * @var value-of<Theme>|null $theme
     */
    #[Optional(enum: Theme::class)]
    public ?string $theme;

    /**
     * Browser viewport in pixels. Defaults to 1920 × 1080. If you pass `viewport`, a missing `width` defaults to 1440 and a missing `height` to 900.
     */
    #[Optional]
    public ?Viewport $viewport;

    /**
     * Time to wait after actions, in milliseconds, or a CSS selector to wait for. Defaults to 500 ms, or 2000 ms when `includeFrames` is `true` or the URL ends in `.xml`.
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
     * @param IncludeFramesShape|null $includeFrames
     * @param list<string>|null $includeSelectors
     * @param Parsers|ParsersShape|null $parsers
     * @param ProfileShape|null $profile
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
        bool|UnionMember1|string|null $includeFrames = null,
        ?array $includeSelectors = null,
        ?bool $mainContentOnly = null,
        Parsers|array|null $parsers = null,
        Existing|array|New_|null $profile = null,
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
        null !== $profile && $self['profile'] = $profile;
        null !== $settleAnimations && $self['settleAnimations'] = $settleAnimations;
        null !== $theme && $self['theme'] = $theme;
        null !== $viewport && $self['viewport'] = $viewport;
        null !== $waitFor && $self['waitFor'] = $waitFor;

        return $self;
    }

    /**
     * Browser steps to run in order before capture. Requires a paid plan. Skips the cache.
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
     * Country to fetch from, as an ISO 3166-1 alpha-2 code such as `US`. Case-insensitive.
     */
    public function withCountry(string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * Accept cookie banners before actions and capture.
     */
    public function withDismissCookies(bool $dismissCookies): self
    {
        $self = clone $this;
        $self['dismissCookies'] = $dismissCookies;

        return $self;
    }

    /**
     * Close other popups before actions and capture.
     */
    public function withDismissPopups(bool $dismissPopups): self
    {
        $self = clone $this;
        $self['dismissPopups'] = $dismissPopups;

        return $self;
    }

    /**
     * Remove elements matching these CSS selectors. Overrides `includeSelectors`.
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
     * HTTP headers to send to the target site. Requests with headers skip the cache.
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
     * Which iframes to inline in HTML and text outputs. Screenshots always show visible frames. `auto` inlines only iframes that hold page content, such as same-site documents, framesets, job boards, forms, and embedded documents, and skips ads and widgets. `true` inlines every iframe; `false` inlines none.
     *
     * @param IncludeFramesShape $includeFrames
     */
    public function withIncludeFrames(
        bool|UnionMember1|string $includeFrames
    ): self {
        $self = clone $this;
        $self['includeFrames'] = $includeFrames;

        return $self;
    }

    /**
     * Keep only elements matching these CSS selectors.
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
     * Keep only the main content, without navigation, headers, footers, or sidebars. Does not affect `screenshot`, `bytes`, or `product`.
     */
    public function withMainContentOnly(bool $mainContentOnly): self
    {
        $self = clone $this;
        $self['mainContentOnly'] = $mainContentOnly;

        return $self;
    }

    /**
     * Options for parsing documents such as PDFs.
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
     * Scrape as a signed-in user. Create a profile with `type: "new"` and your credentials, then reuse it with `type: "existing"`. Requires a paid plan and an HTTPS URL. Profiles keep their session between requests, skip the cache, and cannot be combined with ZDR, custom headers, `formats.bytes`, or prebuilt parsers other than `emails`, `phone-numbers`, and `links`.
     *
     * @param ProfileShape $profile
     */
    public function withProfile(Existing|array|New_ $profile): self
    {
        $self = clone $this;
        $self['profile'] = $profile;

        return $self;
    }

    /**
     * Wait for CSS animations to finish before capture. Defaults to `true` when `formats.screenshot` is `true`.
     */
    public function withSettleAnimations(bool $settleAnimations): self
    {
        $self = clone $this;
        $self['settleAnimations'] = $settleAnimations;

        return $self;
    }

    /**
     * Emulate a light or dark color scheme.
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
     * Browser viewport in pixels. Defaults to 1920 × 1080. If you pass `viewport`, a missing `width` defaults to 1440 and a missing `height` to 900.
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
     * Time to wait after actions, in milliseconds, or a CSS selector to wait for. Defaults to 500 ms, or 2000 ms when `includeFrames` is `true` or the URL ends in `.xml`.
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
