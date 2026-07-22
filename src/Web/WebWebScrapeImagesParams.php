<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebScrapeImagesParams\Action;
use ContextDev\Web\WebWebScrapeImagesParams\Dedupe;
use ContextDev\Web\WebWebScrapeImagesParams\Dedupe\UnionMember1;
use ContextDev\Web\WebWebScrapeImagesParams\Enrichment;

/**
 * Extract image assets from a web page, including standard URLs, inline SVGs, data URIs, responsive image sources, metadata, CSS backgrounds, video posters, and embeds. The base request costs 1 credit, or 2 credits with browser actions. When enrichment is enabled, the entire call costs 5 credits, including requests that also use actions.
 *
 * @see ContextDev\Services\WebService::webScrapeImages()
 *
 * @phpstan-import-type ActionVariants from \ContextDev\Web\WebWebScrapeImagesParams\Action
 * @phpstan-import-type DedupeVariants from \ContextDev\Web\WebWebScrapeImagesParams\Dedupe
 * @phpstan-import-type ActionShape from \ContextDev\Web\WebWebScrapeImagesParams\Action
 * @phpstan-import-type DedupeShape from \ContextDev\Web\WebWebScrapeImagesParams\Dedupe
 * @phpstan-import-type EnrichmentShape from \ContextDev\Web\WebWebScrapeImagesParams\Enrichment
 *
 * @phpstan-type WebWebScrapeImagesParamsShape = array{
 *   url: string,
 *   actions?: list<ActionShape>|null,
 *   dedupe?: DedupeShape|null,
 *   enrichment?: null|Enrichment|EnrichmentShape,
 *   headers?: array<string,string>|null,
 *   maxAgeMs?: int|null,
 *   tags?: list<string>|null,
 *   timeoutMs?: int|null,
 *   waitForMs?: int|null,
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
     * When true, visually duplicate images are removed: every image is loaded and perceptually hashed, and only the highest-resolution copy of each duplicate group is kept. Images that cannot be downloaded or hashed are kept. Default: false.
     *
     * @var DedupeVariants|null $dedupe
     */
    #[Optional(union: Dedupe::class)]
    public bool|string|null $dedupe;

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
     * Optional browser wait time in milliseconds after initial page load before collecting images. Min: 0. Max: 30000 (30 seconds).
     */
    #[Optional(nullable: true)]
    public ?int $waitForMs;

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
     * @param DedupeShape|null $dedupe
     * @param Enrichment|EnrichmentShape|null $enrichment
     * @param array<string,string>|null $headers
     * @param list<string>|null $tags
     */
    public static function with(
        string $url,
        ?array $actions = null,
        bool|UnionMember1|string|null $dedupe = null,
        Enrichment|array|null $enrichment = null,
        ?array $headers = null,
        ?int $maxAgeMs = null,
        ?array $tags = null,
        ?int $timeoutMs = null,
        ?int $waitForMs = null,
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $actions && $self['actions'] = $actions;
        null !== $dedupe && $self['dedupe'] = $dedupe;
        null !== $enrichment && $self['enrichment'] = $enrichment;
        null !== $headers && $self['headers'] = $headers;
        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutMs && $self['timeoutMs'] = $timeoutMs;
        null !== $waitForMs && $self['waitForMs'] = $waitForMs;

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
     * When true, visually duplicate images are removed: every image is loaded and perceptually hashed, and only the highest-resolution copy of each duplicate group is kept. Images that cannot be downloaded or hashed are kept. Default: false.
     *
     * @param DedupeShape $dedupe
     */
    public function withDedupe(bool|UnionMember1|string $dedupe): self
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
     * Optional browser wait time in milliseconds after initial page load before collecting images. Min: 0. Max: 30000 (30 seconds).
     */
    public function withWaitForMs(?int $waitForMs): self
    {
        $self = clone $this;
        $self['waitForMs'] = $waitForMs;

        return $self;
    }
}
