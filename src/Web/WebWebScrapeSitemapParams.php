<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Crawl an entire website's sitemap and return all discovered page URLs.
 *
 * @see ContextDev\Services\WebService::webScrapeSitemap()
 *
 * @phpstan-type WebWebScrapeSitemapParamsShape = array{
 *   domain: string,
 *   headers?: array<string,string>|null,
 *   maxLinks?: int|null,
 *   sitemapURL?: string|null,
 *   tags?: list<string>|null,
 *   timeoutMs?: int|null,
 *   urlRegex?: string|null,
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
     */
    public static function with(
        string $domain,
        ?array $headers = null,
        ?int $maxLinks = null,
        ?string $sitemapURL = null,
        ?array $tags = null,
        ?int $timeoutMs = null,
        ?string $urlRegex = null,
    ): self {
        $self = new self;

        $self['domain'] = $domain;

        null !== $headers && $self['headers'] = $headers;
        null !== $maxLinks && $self['maxLinks'] = $maxLinks;
        null !== $sitemapURL && $self['sitemapURL'] = $sitemapURL;
        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutMs && $self['timeoutMs'] = $timeoutMs;
        null !== $urlRegex && $self['urlRegex'] = $urlRegex;

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
}
