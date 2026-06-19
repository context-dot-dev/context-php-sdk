<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebScrapeImagesParams\Enrichment;

/**
 * Extract image assets from a web page, including standard URLs, inline SVGs, data URIs, responsive image sources, metadata, CSS backgrounds, video posters, and embeds. The base request costs 1 credit. When enrichment is enabled, the entire call costs 5 credits.
 *
 * @see ContextDev\Services\WebService::webScrapeImages()
 *
 * @phpstan-import-type EnrichmentShape from \ContextDev\Web\WebWebScrapeImagesParams\Enrichment
 *
 * @phpstan-type WebWebScrapeImagesParamsShape = array{
 *   url: string,
 *   enrichment?: null|Enrichment|EnrichmentShape,
 *   headers?: array<string,string>|null,
 *   maxAgeMs?: int|null,
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
     * Optional per-image processing, sent as deep-object query params such as enrichment[resolution]=true.
     */
    #[Optional]
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
    #[Optional]
    public ?int $maxAgeMs;

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    #[Optional]
    public ?int $timeoutMs;

    /**
     * Optional browser wait time in milliseconds after initial page load before collecting images. Min: 0. Max: 30000 (30 seconds).
     */
    #[Optional]
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
     * @param Enrichment|EnrichmentShape|null $enrichment
     * @param array<string,string>|null $headers
     */
    public static function with(
        string $url,
        Enrichment|array|null $enrichment = null,
        ?array $headers = null,
        ?int $maxAgeMs = null,
        ?int $timeoutMs = null,
        ?int $waitForMs = null,
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $enrichment && $self['enrichment'] = $enrichment;
        null !== $headers && $self['headers'] = $headers;
        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
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
     * Optional per-image processing, sent as deep-object query params such as enrichment[resolution]=true.
     *
     * @param Enrichment|EnrichmentShape $enrichment
     */
    public function withEnrichment(Enrichment|array $enrichment): self
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
    public function withMaxAgeMs(int $maxAgeMs): self
    {
        $self = clone $this;
        $self['maxAgeMs'] = $maxAgeMs;

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
    public function withWaitForMs(int $waitForMs): self
    {
        $self = clone $this;
        $self['waitForMs'] = $waitForMs;

        return $self;
    }
}
