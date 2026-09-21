<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebScrapeImagesParams\Action;
use ContextDev\Web\WebWebScrapeImagesParams\Country;
use ContextDev\Web\WebWebScrapeImagesParams\Enrichment;
use ContextDev\Web\WebWebScrapeImagesParams\TimeoutOpts;
use ContextDev\Web\WebWebScrapeImagesParams\Zdr;

/**
 * Extract image assets from a web page, including standard URLs, inline SVGs, data URIs, responsive image sources, metadata, CSS backgrounds, video posters, and embeds. The base request costs 1 credit, or 2 credits with browser actions. When enrichment is enabled, the entire call costs 5 credits, including requests that also use actions.
 *
 * @see ContextDev\Services\WebService::webScrapeImages()
 *
 * @phpstan-import-type ActionVariants from \ContextDev\Web\WebWebScrapeImagesParams\Action
 * @phpstan-import-type ActionShape from \ContextDev\Web\WebWebScrapeImagesParams\Action
 * @phpstan-import-type EnrichmentShape from \ContextDev\Web\WebWebScrapeImagesParams\Enrichment
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebWebScrapeImagesParams\TimeoutOpts
 *
 * @phpstan-type WebWebScrapeImagesParamsShape = array{
 *   url: string,
 *   actions?: list<ActionShape>|null,
 *   country?: null|Country|value-of<Country>,
 *   dedupe?: bool|null,
 *   enrichment?: null|Enrichment|EnrichmentShape,
 *   headers?: array<string,string>|null,
 *   maxAgeMs?: int|null,
 *   tags?: list<string>|null,
 *   timeoutOpts?: null|TimeoutOpts|TimeoutOptsShape,
 *   waitForMs?: int|null,
 *   zdr?: null|Zdr|value-of<Zdr>,
 * }
 */
final class WebWebScrapeImagesParams implements BaseModel
{
    /** @use SdkModel<WebWebScrapeImagesParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Page URL to inspect. Must include http:// or https://.
     */
    #[Required]
    public string $url;

    /**
     * Optional browser actions executed in array order after the page loads and before content is captured. Requires a paid plan. Send a JSON array in the query parameter. Maximum: 5 actions.
     *
     * @var list<ActionVariants>|null $actions
     */
    #[Optional(list: Action::class, nullable: true)]
    public ?array $actions;

    /**
     * Fetch the target page through a residential proxy in this country (ISO 3166-1 alpha-2).
     *
     * @var value-of<Country>|null $country
     */
    #[Optional(enum: Country::class)]
    public ?string $country;

    /**
     * When true, visually duplicate images are removed: every image is loaded and perceptually hashed, and only the highest-resolution copy of each duplicate group is kept. Images that cannot be downloaded or hashed are kept. Default: false.
     */
    #[Optional]
    public ?bool $dedupe;

    /**
     * Optional per-image processing, sent as deep-object query params such as enrichment[resolution]=true.
     */
    #[Optional(nullable: true)]
    public ?Enrichment $enrichment;

    /**
     * Optional outbound HTTP headers forwarded only to the target URL, sent as deep-object query params such as headers[X-Custom]=value. When provided, caching is bypassed: the result is neither read from nor written to cache.
     *
     * @var array<string,string>|null $headers
     */
    #[Optional(map: 'string')]
    public ?array $headers;

    /**
     * Reuse a cached result this many milliseconds old or newer. Default: 86400000 (1 day). Set to 0 to bypass cache. Maximum: 2592000000 (30 days).
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
     * Optional browser wait time in milliseconds after initial page load before collecting images. Min: 0. Max: 30000 (30 seconds). When combined with timeoutOpts, timeoutOpts.milliseconds must be at least waitForMs + 10000 ms; a shorter deadline is rejected with 400 TIMEOUT_TOO_SHORT_FOR_WAIT.
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
     * `new WebWebScrapeImagesParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebWebScrapeImagesParams::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebWebScrapeImagesParams)->withURL(...)
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
     * @param list<ActionShape>|null $actions
     * @param Country|value-of<Country>|null $country
     * @param Enrichment|EnrichmentShape|null $enrichment
     * @param array<string,string>|null $headers
     * @param list<string>|null $tags
     * @param TimeoutOpts|TimeoutOptsShape|null $timeoutOpts
     * @param Zdr|value-of<Zdr>|null $zdr
     */
    public static function with(
        string $url,
        ?array $actions = null,
        Country|string|null $country = null,
        ?bool $dedupe = null,
        Enrichment|array|null $enrichment = null,
        ?array $headers = null,
        ?int $maxAgeMs = null,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
        ?int $waitForMs = null,
        Zdr|string|null $zdr = null,
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $actions && $self['actions'] = $actions;
        null !== $country && $self['country'] = $country;
        null !== $dedupe && $self['dedupe'] = $dedupe;
        null !== $enrichment && $self['enrichment'] = $enrichment;
        null !== $headers && $self['headers'] = $headers;
        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutOpts && $self['timeoutOpts'] = $timeoutOpts;
        null !== $waitForMs && $self['waitForMs'] = $waitForMs;
        null !== $zdr && $self['zdr'] = $zdr;

        return $self;
    }

    /**
     * Page URL to inspect. Must include http:// or https://.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Optional browser actions executed in array order after the page loads and before content is captured. Requires a paid plan. Send a JSON array in the query parameter. Maximum: 5 actions.
     *
     * @param list<ActionShape>|null $actions
     */
    public function withActions(?array $actions): self
    {
        $self = clone $this;
        $self['actions'] = $actions;

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
     * When true, visually duplicate images are removed: every image is loaded and perceptually hashed, and only the highest-resolution copy of each duplicate group is kept. Images that cannot be downloaded or hashed are kept. Default: false.
     */
    public function withDedupe(bool $dedupe): self
    {
        $self = clone $this;
        $self['dedupe'] = $dedupe;

        return $self;
    }

    /**
     * Optional per-image processing, sent as deep-object query params such as enrichment[resolution]=true.
     *
     * @param Enrichment|EnrichmentShape|null $enrichment
     */
    public function withEnrichment(Enrichment|array|null $enrichment): self
    {
        $self = clone $this;
        $self['enrichment'] = $enrichment;

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
     * Reuse a cached result this many milliseconds old or newer. Default: 86400000 (1 day). Set to 0 to bypass cache. Maximum: 2592000000 (30 days).
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
     * Optional browser wait time in milliseconds after initial page load before collecting images. Min: 0. Max: 30000 (30 seconds). When combined with timeoutOpts, timeoutOpts.milliseconds must be at least waitForMs + 10000 ms; a shorter deadline is rejected with 400 TIMEOUT_TOO_SHORT_FOR_WAIT.
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
