<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebExtractStyleguideParams\ColorScheme;
use ContextDev\Web\WebExtractStyleguideParams\TimeoutOpts;

/**
 * Extract a comprehensive design system from a website including colors, typography, spacing, shadows, and UI components.
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
     * A specific URL to fetch the styleguide from directly, bypassing domain resolution (e.g., 'https://example.com/design-system'). When provided, the styleguide is extracted from this exact URL. You must provide either 'domain' or 'directUrl', but not both.
     */
    #[Optional]
    public ?string $directURL;

    /**
     * Domain name to extract styleguide from (e.g., 'example.com', 'google.com'). The domain will be automatically normalized and validated. You must provide either 'domain' or 'directUrl', but not both.
     */
    #[Optional]
    public ?string $domain;

    /**
     * Maximum age in milliseconds for cached brand data before the API performs a hard refresh. Defaults to 3 months (7776000000 ms). Set to 0 to always perform a hard refresh. Negative values are clamped to 0; values above 1 year (31536000000 ms) are clamped to 1 year.
     */
    #[Optional(nullable: true)]
    public ?int $maxAgeMs;

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
     */
    public static function with(
        ColorScheme|string|null $colorScheme = null,
        ?string $directURL = null,
        ?string $domain = null,
        ?int $maxAgeMs = null,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
    ): self {
        $self = new self;

        null !== $colorScheme && $self['colorScheme'] = $colorScheme;
        null !== $directURL && $self['directURL'] = $directURL;
        null !== $domain && $self['domain'] = $domain;
        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutOpts && $self['timeoutOpts'] = $timeoutOpts;

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
     * A specific URL to fetch the styleguide from directly, bypassing domain resolution (e.g., 'https://example.com/design-system'). When provided, the styleguide is extracted from this exact URL. You must provide either 'domain' or 'directUrl', but not both.
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
     * Maximum age in milliseconds for cached brand data before the API performs a hard refresh. Defaults to 3 months (7776000000 ms). Set to 0 to always perform a hard refresh. Negative values are clamped to 0; values above 1 year (31536000000 ms) are clamped to 1 year.
     */
    public function withMaxAgeMs(?int $maxAgeMs): self
    {
        $self = clone $this;
        $self['maxAgeMs'] = $maxAgeMs;

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
}
