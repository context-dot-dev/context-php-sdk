<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebScrapeBytesParams\Country;
use ContextDev\Web\WebWebScrapeBytesParams\TimeoutOpts;
use ContextDev\Web\WebWebScrapeBytesParams\Zdr;

/**
 * Downloads a resource and returns its bytes as base64. Without waitForMs, returns the original HTTP response without image conversion, text extraction, or character-encoding changes. HTTP compression is decoded before base64 encoding. Supply waitForMs to render HTML with JavaScript in the browser and return the resulting HTML as UTF-8 bytes after the wait. Non-HTML resources, including images and PDFs, keep their original bytes and do not incur a browser wait. Follows public redirects and retries failed downloads through ISP and residential proxies, with a direct fallback. When country is specified, only a residential proxy in that country is used. Supply headers such as Referer for images that require a referring page. Cached results are reused according to maxAgeMs (default: 1 day; maximum: 30 days). Set maxAgeMs=0 to fetch fresh and refresh the cache. Cache identity includes the exact URL, country, waitForMs, and normalized outbound headers. Credential-bearing headers and zero data retention bypass cache reads and writes. cache_metadata reports hit, miss, or zdr and the cached result age in milliseconds. Maximum decoded resource size: 20 MiB (20971520 bytes), before base64 encoding. Successful requests cost 1 credit; errors are not billed.
 *
 * @see ContextDev\Services\WebService::webScrapeBytes()
 *
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebWebScrapeBytesParams\TimeoutOpts
 *
 * @phpstan-type WebWebScrapeBytesParamsShape = array{
 *   url: string,
 *   country?: null|Country|value-of<Country>,
 *   headers?: array<string,string>|null,
 *   maxAgeMs?: int|null,
 *   tags?: list<string>|null,
 *   timeoutOpts?: null|TimeoutOpts|TimeoutOptsShape,
 *   waitForMs?: int|null,
 *   zdr?: null|Zdr|value-of<Zdr>,
 * }
 */
final class WebWebScrapeBytesParams implements BaseModel
{
    /** @use SdkModel<WebWebScrapeBytesParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Full HTTP(S) URL of the resource to download, such as an image, PDF, or page.
     */
    #[Required]
    public string $url;

    /**
     * Fetch the target page through a residential proxy in this country (ISO 3166-1 alpha-2).
     *
     * @var value-of<Country>|null $country
     */
    #[Optional(enum: Country::class)]
    public ?string $country;

    /**
     * Optional outbound HTTP headers, such as Referer, Cookie, or Authorization. Send as a JSON object or deep-object query params such as headers[Referer]=https://example.com/. Host, Content-Length, and hop-by-hop transport headers are rejected. Authorization and cookies are removed when a redirect changes origin. Credential-bearing headers bypass cache reads and writes; other headers are included in the cache key.
     *
     * @var array<string,string>|null $headers
     */
    #[Optional(map: 'string')]
    public ?array $headers;

    /**
     * Return a cached result if a prior scrape for the same parameters exists and is younger than this many milliseconds. Defaults to 1 day (86400000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always scrape fresh.
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

    /**
     * Optional browser wait time after initial page load, in milliseconds (0–30000; 0 uses 500). When supplied, HTML is rendered with JavaScript and returned as UTF-8 bytes. Other resources keep their original bytes without a browser wait. Omit to download the original HTTP response. When combined with timeoutOpts, timeoutOpts.milliseconds must be at least waitForMs + 10000 ms; a shorter deadline is rejected with 400 TIMEOUT_TOO_SHORT_FOR_WAIT.
     */
    #[Optional(nullable: true)]
    public ?int $waitForMs;

    /**
     * Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Asset uploads are skipped, so hosted image URLs are omitted. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
     *
     * @var value-of<Zdr>|null $zdr
     */
    #[Optional(enum: Zdr::class)]
    public ?string $zdr;

    /**
     * `new WebWebScrapeBytesParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebWebScrapeBytesParams::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebWebScrapeBytesParams)->withURL(...)
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
     * @param Country|value-of<Country>|null $country
     * @param array<string,string>|null $headers
     * @param list<string>|null $tags
     * @param TimeoutOpts|TimeoutOptsShape|null $timeoutOpts
     * @param Zdr|value-of<Zdr>|null $zdr
     */
    public static function with(
        string $url,
        Country|string|null $country = null,
        ?array $headers = null,
        ?int $maxAgeMs = null,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
        ?int $waitForMs = null,
        Zdr|string|null $zdr = null,
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $country && $self['country'] = $country;
        null !== $headers && $self['headers'] = $headers;
        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutOpts && $self['timeoutOpts'] = $timeoutOpts;
        null !== $waitForMs && $self['waitForMs'] = $waitForMs;
        null !== $zdr && $self['zdr'] = $zdr;

        return $self;
    }

    /**
     * Full HTTP(S) URL of the resource to download, such as an image, PDF, or page.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Fetch the target page through a residential proxy in this country (ISO 3166-1 alpha-2).
     *
     * @param Country|value-of<Country> $country
     */
    public function withCountry(Country|string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * Optional outbound HTTP headers, such as Referer, Cookie, or Authorization. Send as a JSON object or deep-object query params such as headers[Referer]=https://example.com/. Host, Content-Length, and hop-by-hop transport headers are rejected. Authorization and cookies are removed when a redirect changes origin. Credential-bearing headers bypass cache reads and writes; other headers are included in the cache key.
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
     * Return a cached result if a prior scrape for the same parameters exists and is younger than this many milliseconds. Defaults to 1 day (86400000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always scrape fresh.
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

    /**
     * Optional browser wait time after initial page load, in milliseconds (0–30000; 0 uses 500). When supplied, HTML is rendered with JavaScript and returned as UTF-8 bytes. Other resources keep their original bytes without a browser wait. Omit to download the original HTTP response. When combined with timeoutOpts, timeoutOpts.milliseconds must be at least waitForMs + 10000 ms; a shorter deadline is rejected with 400 TIMEOUT_TOO_SHORT_FOR_WAIT.
     */
    public function withWaitForMs(?int $waitForMs): self
    {
        $self = clone $this;
        $self['waitForMs'] = $waitForMs;

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
