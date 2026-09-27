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
 * Extract colors, typography, spacing, and component styles from a website.
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
     * Optional browser color scheme to emulate for websites that respond to prefers-color-scheme. This value is part of the styleguide cache key.
     *
     * @var value-of<ColorScheme>|null $colorScheme
     */
    #[Optional(enum: ColorScheme::class)]
    public ?string $colorScheme;

    /**
     * Exact URL to inspect. Provide either `domain` or `directUrl`, not both.
     */
    #[Optional]
    public ?string $directURL;

    /**
     * Domain name to extract styleguide from (e.g., 'example.com', 'google.com'). The domain will be automatically normalized and validated. You must provide either 'domain' or 'directUrl', but not both.
     */
    #[Optional]
    public ?string $domain;

    /**
     * Maximum age of cached brand data in ms. Defaults to 3 months; clamped to 0–1 year. `0` refreshes.
     */
    #[Optional(nullable: true)]
    public ?int $maxAgeMs;

    /**
     * Comma-separated labels for filtering usage, e.g. `production,team-alpha`.
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
     * @param list<string>|null $tags
     * @param TimeoutOpts|TimeoutOptsShape|null $timeoutOpts
     * @param Zdr|value-of<Zdr>|null $zdr
     */
    public static function with(
        ColorScheme|string|null $colorScheme = null,
        ?string $directURL = null,
        ?string $domain = null,
        ?int $maxAgeMs = null,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
        Zdr|string|null $zdr = null,
    ): self {
        $self = new self;

        null !== $colorScheme && $self['colorScheme'] = $colorScheme;
        null !== $directURL && $self['directURL'] = $directURL;
        null !== $domain && $self['domain'] = $domain;
        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutOpts && $self['timeoutOpts'] = $timeoutOpts;
        null !== $zdr && $self['zdr'] = $zdr;

        return $self;
    }

    /**
     * Optional browser color scheme to emulate for websites that respond to prefers-color-scheme. This value is part of the styleguide cache key.
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
     * Exact URL to inspect. Provide either `domain` or `directUrl`, not both.
     */
    public function withDirectURL(string $directURL): self
    {
        $self = clone $this;
        $self['directURL'] = $directURL;

        return $self;
    }

    /**
     * Domain name to extract styleguide from (e.g., 'example.com', 'google.com'). The domain will be automatically normalized and validated. You must provide either 'domain' or 'directUrl', but not both.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Maximum age of cached brand data in ms. Defaults to 3 months; clamped to 0–1 year. `0` refreshes.
     */
    public function withMaxAgeMs(?int $maxAgeMs): self
    {
        $self = clone $this;
        $self['maxAgeMs'] = $maxAgeMs;

        return $self;
    }

    /**
     * Comma-separated labels for filtering usage, e.g. `production,team-alpha`.
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
