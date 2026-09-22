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
 * Discovers URLs using the same sitemap crawl, filters, and limits as /web/scrape/sitemap. Each URL includes its available title, description, keywords, and language. URLs without stored enrichment are returned immediately with only the URL and queued for background HTML scraping, so later requests can include their metadata. Responses are never cached as a whole; every request reads the current per-URL enrichment. Zero data retention and credential-bearing discovery requests return URLs without reading or storing shared enrichment or queuing background scrapes. Costs 1 credit, or 2 credits with search.
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
     * Domain to build a sitemap for.
     */
    #[Required]
    public string $domain;

    /**
     * Optional outbound HTTP headers forwarded only to the target URL, sent as deep-object query params such as headers[X-Custom]=value. When provided, caching is bypassed: the result is neither read from nor written to cache.
     *
     * @var array<string,string>|null $headers
     */
    #[Optional(map: 'string')]
    public ?array $headers;

    /**
     * When true, discover and include public pages and sitemaps on subdomains of the requested domain. Defaults to false.
     */
    #[Optional]
    public ?bool $includeSubdomains;

    /**
     * Maximum number of links to return from the sitemap crawl. Defaults to 10,000. Minimum is 1, maximum is 100,000.
     */
    #[Optional]
    public ?int $maxLinks;

    /**
     * Optional search phrase. When provided, the crawled sitemap is filtered to the pages whose URLs are about that phrase, most relevant first, and the request costs 2 credits instead of 1.
     */
    #[Optional]
    public ?string $search;

    /**
     * Optional explicit sitemap URL. When provided, exactly this sitemap is crawled instead of discovering the domain's sitemaps.
     */
    #[Optional]
    public ?string $sitemapURL;

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
     * Optional RE2-compatible regex pattern. Only URLs matching this pattern are returned and counted against maxLinks.
     */
    #[Optional]
    public ?string $urlRegex;

    /**
     * Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Asset uploads are skipped, so hosted image URLs are omitted. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
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
     * Domain to build a sitemap for.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Optional outbound HTTP headers forwarded only to the target URL, sent as deep-object query params such as headers[X-Custom]=value. When provided, caching is bypassed: the result is neither read from nor written to cache.
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
     * When true, discover and include public pages and sitemaps on subdomains of the requested domain. Defaults to false.
     */
    public function withIncludeSubdomains(bool $includeSubdomains): self
    {
        $self = clone $this;
        $self['includeSubdomains'] = $includeSubdomains;

        return $self;
    }

    /**
     * Maximum number of links to return from the sitemap crawl. Defaults to 10,000. Minimum is 1, maximum is 100,000.
     */
    public function withMaxLinks(int $maxLinks): self
    {
        $self = clone $this;
        $self['maxLinks'] = $maxLinks;

        return $self;
    }

    /**
     * Optional search phrase. When provided, the crawled sitemap is filtered to the pages whose URLs are about that phrase, most relevant first, and the request costs 2 credits instead of 1.
     */
    public function withSearch(string $search): self
    {
        $self = clone $this;
        $self['search'] = $search;

        return $self;
    }

    /**
     * Optional explicit sitemap URL. When provided, exactly this sitemap is crawled instead of discovering the domain's sitemaps.
     */
    public function withSitemapURL(string $sitemapURL): self
    {
        $self = clone $this;
        $self['sitemapURL'] = $sitemapURL;

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
     * Optional RE2-compatible regex pattern. Only URLs matching this pattern are returned and counted against maxLinks.
     */
    public function withURLRegex(string $urlRegex): self
    {
        $self = clone $this;
        $self['urlRegex'] = $urlRegex;

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
