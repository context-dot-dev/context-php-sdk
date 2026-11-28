<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebExtractStyleguideParams\ColorScheme;
use ContextDev\Web\WebExtractStyleguideParams\TimeoutOpts;
use ContextDev\Web\WebExtractStyleguideParams\Zdr;

/**
 * Extract a website's design system: colors, typography, spacing, shadows, button and card styles, and downloadable font files. Every component style includes ready-to-use CSS.
 *
 * @see ContextDev\Services\WebService::extractStyleguide()
 *
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebExtractStyleguideParams\TimeoutOpts
 *
 * @phpstan-type WebExtractStyleguideParamsShape = array{
 *   colorScheme?: null|ColorScheme|value-of<ColorScheme>,
 *   directURL?: string|null,
 *   domain?: string|null,
 *   maxAgeMs?: int|null,
 *   policies?: list<string>|null,
 *   tags?: list<string>|null,
 *   timeoutOpts?: null|TimeoutOpts|TimeoutOptsShape,
 *   zdr?: null|Zdr|value-of<Zdr>,
 * }
 */
final class WebExtractStyleguideParams implements BaseModel
{
    /** @use SdkModel<WebExtractStyleguideParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Emulate a light or dark color scheme. Each scheme is cached separately.
     *
     * @var value-of<ColorScheme>|null $colorScheme
     */
    #[Optional(enum: ColorScheme::class)]
    public ?string $colorScheme;

    /**
     * Exact page URL to analyze. Provide either `domain` or `directUrl`, not both.
     */
    #[Optional]
    public ?string $directURL;

    /**
     * Domain to analyze, such as `stripe.com`. Provide either `domain` or `directUrl`, not both.
     */
    #[Optional]
    public ?string $domain;

    /**
     * Maximum age of a cached result, in milliseconds. `0` always fetches fresh. Defaults to 90 days (7776000000 ms). Values above 1 year (31536000000 ms) are capped at 1 year.
     */
    #[Optional(nullable: true)]
    public ?int $maxAgeMs;

    /**
     * Comma-separated access policy IDs to apply; each URL must pass all of them. Requires access policies enabled for your organization; otherwise returns `ACCESS_POLICIES_NOT_ENABLED`.
     *
     * @var list<string>|null $policies
     */
    #[Optional(list: 'string')]
    public ?array $policies;

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
     * `enabled` turns off request logs and traces and keeps request and response content out of usage logs. Brand data and hosted assets may still be stored. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
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
     * @param list<string>|null $policies
     * @param list<string>|null $tags
     * @param TimeoutOpts|TimeoutOptsShape|null $timeoutOpts
     * @param Zdr|value-of<Zdr>|null $zdr
     */
    public static function with(
        ColorScheme|string|null $colorScheme = null,
        ?string $directURL = null,
        ?string $domain = null,
        ?int $maxAgeMs = null,
        ?array $policies = null,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
        Zdr|string|null $zdr = null,
    ): self {
        $self = new self;

        null !== $colorScheme && $self['colorScheme'] = $colorScheme;
        null !== $directURL && $self['directURL'] = $directURL;
        null !== $domain && $self['domain'] = $domain;
        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
        null !== $policies && $self['policies'] = $policies;
        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutOpts && $self['timeoutOpts'] = $timeoutOpts;
        null !== $zdr && $self['zdr'] = $zdr;

        return $self;
    }

    /**
     * Emulate a light or dark color scheme. Each scheme is cached separately.
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
     * Exact page URL to analyze. Provide either `domain` or `directUrl`, not both.
     */
    public function withDirectURL(string $directURL): self
    {
        $self = clone $this;
        $self['directURL'] = $directURL;

        return $self;
    }

    /**
     * Domain to analyze, such as `stripe.com`. Provide either `domain` or `directUrl`, not both.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Maximum age of a cached result, in milliseconds. `0` always fetches fresh. Defaults to 90 days (7776000000 ms). Values above 1 year (31536000000 ms) are capped at 1 year.
     */
    public function withMaxAgeMs(?int $maxAgeMs): self
    {
        $self = clone $this;
        $self['maxAgeMs'] = $maxAgeMs;

        return $self;
    }

    /**
     * Comma-separated access policy IDs to apply; each URL must pass all of them. Requires access policies enabled for your organization; otherwise returns `ACCESS_POLICIES_NOT_ENABLED`.
     *
     * @param list<string> $policies
     */
    public function withPolicies(array $policies): self
    {
        $self = clone $this;
        $self['policies'] = $policies;

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
     * `enabled` turns off request logs and traces and keeps request and response content out of usage logs. Brand data and hosted assets may still be stored. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
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
