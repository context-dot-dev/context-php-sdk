<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebScrapeSitemapParams\Zdr;

/**
 * Crawl an entire website's sitemap and return all discovered page URLs. Pass `search` to have the crawled sitemap filtered down to the pages about a phrase (for example `pricing and plans` or `api authentication docs`), most relevant first — a searched crawl scans the whole sitemap and costs 2 credits instead of 1.
 *
 * @see ContextDev\Services\WebService::webScrapeSitemap()
 *
 * @phpstan-type WebWebScrapeSitemapParamsShape = array{
 *   domain: string,
 *   headers?: array<string,string>|null,
 *   maxLinks?: int|null,
 *   search?: string|null,
 *   sitemapURL?: string|null,
 *   tags?: list<string>|null,
 *   timeoutMs?: int|null,
 *   urlRegex?: string|null,
 *   zdr?: null|Zdr|value-of<Zdr>,
 * }
 */
final class WebWebScrapeSitemapParams implements BaseModel
{
    /** @use SdkModel<WebWebScrapeSitemapParamsShape> */
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
     * Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    #[Optional]
    public ?int $timeoutMs;

    /**
     * Optional RE2-compatible regex pattern. Only URLs matching this pattern are returned and counted against maxLinks.
     */
    #[Optional]
    public ?string $urlRegex;

    /**
     * Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
     *
     * @var value-of<Zdr>|null $zdr
     */
    #[Optional(enum: Zdr::class)]
    public ?string $zdr;

    /**
     * `new WebWebScrapeSitemapParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebWebScrapeSitemapParams::with(domain: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebWebScrapeSitemapParams)->withDomain(...)
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
     * @param Zdr|value-of<Zdr>|null $zdr
     */
    public static function with(
        string $domain,
        ?array $headers = null,
        ?int $maxLinks = null,
        ?string $search = null,
        ?string $sitemapURL = null,
        ?array $tags = null,
        ?int $timeoutMs = null,
        ?string $urlRegex = null,
        Zdr|string|null $zdr = null,
    ): self {
        $self = new self;

        $self['domain'] = $domain;

        null !== $headers && $self['headers'] = $headers;
        null !== $maxLinks && $self['maxLinks'] = $maxLinks;
        null !== $search && $self['search'] = $search;
        null !== $sitemapURL && $self['sitemapURL'] = $sitemapURL;
        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutMs && $self['timeoutMs'] = $timeoutMs;
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
     * Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
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
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    public function withTimeoutMs(int $timeoutMs): self
    {
        $self = clone $this;
        $self['timeoutMs'] = $timeoutMs;

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
     * Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
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
