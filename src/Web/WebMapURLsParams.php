<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebMapURLsParams\TimeoutOpts;
use ContextDev\Web\WebMapURLsParams\Zdr;

/**
 * Discover a site's URLs, with page titles, descriptions, keywords, and language when available. Metadata can be missing on newly discovered URLs.
 *
 * @see ContextDev\Services\WebService::mapUrls()
 *
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebMapURLsParams\TimeoutOpts
 *
 * @phpstan-type WebMapURLsParamsShape = array{
 *   domain: string,
 *   headers?: array<string,string>|null,
 *   includeSubdomains?: bool|null,
 *   maxLinks?: int|null,
 *   search?: string|null,
 *   sitemapURL?: string|null,
 *   tags?: list<string>|null,
 *   timeoutOpts?: null|TimeoutOpts|TimeoutOptsShape,
 *   urlRegex?: string|null,
 *   zdr?: null|Zdr|value-of<Zdr>,
 * }
 */
final class WebMapURLsParams implements BaseModel
{
    /** @use SdkModel<WebMapURLsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Domain to map, e.g. `stripe.com`.
     */
    #[Required]
    public string $domain;

    /**
     * HTTP headers for the target origin. Non-empty headers bypass caching.
     *
     * @var array<string,string>|null $headers
     */
    #[Optional(map: 'string')]
    public ?array $headers;

    /**
     * Include URLs on subdomains.
     */
    #[Optional]
    public ?bool $includeSubdomains;

    /**
     * Maximum number of URLs to return.
     */
    #[Optional]
    public ?int $maxLinks;

    /**
     * Filter URLs by a topic or phrase, most relevant first.
     */
    #[Optional]
    public ?string $search;

    /**
     * Fetch this sitemap instead of discovering sitemaps. Must belong to the domain or a subdomain.
     */
    #[Optional]
    public ?string $sitemapURL;

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
     * Optional RE2-compatible regex pattern. Only URLs matching this pattern are returned and counted against maxLinks.
     */
    #[Optional]
    public ?string $urlRegex;

    /**
     * `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     *
     * @var value-of<Zdr>|null $zdr
     */
    #[Optional(enum: Zdr::class)]
    public ?string $zdr;

    /**
     * `new WebMapURLsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebMapURLsParams::with(domain: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebMapURLsParams)->withDomain(...)
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
     * @param array<string,string>|null $headers
     * @param list<string>|null $tags
     * @param TimeoutOpts|TimeoutOptsShape|null $timeoutOpts
     * @param Zdr|value-of<Zdr>|null $zdr
     */
    public static function with(
        string $domain,
        ?array $headers = null,
        ?bool $includeSubdomains = null,
        ?int $maxLinks = null,
        ?string $search = null,
        ?string $sitemapURL = null,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
        ?string $urlRegex = null,
        Zdr|string|null $zdr = null,
    ): self {
        $self = new self;

        $self['domain'] = $domain;

        null !== $headers && $self['headers'] = $headers;
        null !== $includeSubdomains && $self['includeSubdomains'] = $includeSubdomains;
        null !== $maxLinks && $self['maxLinks'] = $maxLinks;
        null !== $search && $self['search'] = $search;
        null !== $sitemapURL && $self['sitemapURL'] = $sitemapURL;
        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutOpts && $self['timeoutOpts'] = $timeoutOpts;
        null !== $urlRegex && $self['urlRegex'] = $urlRegex;
        null !== $zdr && $self['zdr'] = $zdr;

        return $self;
    }

    /**
     * Domain to map, e.g. `stripe.com`.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * HTTP headers for the target origin. Non-empty headers bypass caching.
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
     * Include URLs on subdomains.
     */
    public function withIncludeSubdomains(bool $includeSubdomains): self
    {
        $self = clone $this;
        $self['includeSubdomains'] = $includeSubdomains;

        return $self;
    }

    /**
     * Maximum number of URLs to return.
     */
    public function withMaxLinks(int $maxLinks): self
    {
        $self = clone $this;
        $self['maxLinks'] = $maxLinks;

        return $self;
    }

    /**
     * Filter URLs by a topic or phrase, most relevant first.
     */
    public function withSearch(string $search): self
    {
        $self = clone $this;
        $self['search'] = $search;

        return $self;
    }

    /**
     * Fetch this sitemap instead of discovering sitemaps. Must belong to the domain or a subdomain.
     */
    public function withSitemapURL(string $sitemapURL): self
    {
        $self = clone $this;
        $self['sitemapURL'] = $sitemapURL;

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
     * Optional RE2-compatible regex pattern. Only URLs matching this pattern are returned and counted against maxLinks.
     */
    public function withURLRegex(string $urlRegex): self
    {
        $self = clone $this;
        $self['urlRegex'] = $urlRegex;

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
