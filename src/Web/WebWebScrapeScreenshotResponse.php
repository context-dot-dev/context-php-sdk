<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebScrapeScreenshotResponse\CacheMetadata;
use ContextDev\Web\WebWebScrapeScreenshotResponse\FinalDomState;
use ContextDev\Web\WebWebScrapeScreenshotResponse\KeyMetadata;

/**
 * @phpstan-import-type CacheMetadataShape from \ContextDev\Web\WebWebScrapeScreenshotResponse\CacheMetadata
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Web\WebWebScrapeScreenshotResponse\KeyMetadata
 *
 * @phpstan-type WebWebScrapeScreenshotResponseShape = array{
 *   cacheMetadata: CacheMetadata|CacheMetadataShape,
 *   height: int,
 *   requestID: string,
 *   screenshot: string,
 *   url: string,
 *   width: int,
 *   finalDomState?: null|FinalDomState|value-of<FinalDomState>,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class WebWebScrapeScreenshotResponse implements BaseModel
{
    /** @use SdkModel<WebWebScrapeScreenshotResponseShape> */
    use SdkModel;

    /**
     * Cache outcome for this response. Composite responses are hits only when every cache-controlled fetch contributing to the output was a hit; age_ms is the oldest contributing hit.
     */
    #[Required('cache_metadata')]
    public CacheMetadata $cacheMetadata;

    /**
     * Height of the returned image in pixels.
     */
    #[Required]
    public int $height;

    /**
     * Unique id of this API call, also sent in the X-Request-Id response header. Quote it when contacting support about a failed request.
     */
    #[Required('request_id')]
    public string $requestID;

    /**
     * Public image URL for standard requests, or an in-memory data URL when ZDR or non-empty custom headers are supplied.
     */
    #[Required]
    public string $screenshot;

    /**
     * The requested page URL.
     */
    #[Required]
    public string $url;

    /**
     * Width of the returned image in pixels.
     */
    #[Required]
    public int $width;

    /**
     * How complete the returned content is. `loaded` means the page finished the waits the request asked for. `still-loading` only occurs with timeoutOpts.behavior=return-partial: the timeoutOpts.milliseconds deadline was reached first, so the content reflects the DOM at that moment and late-rendering parts may be missing. Partial results are billed at the base request cost.
     *
     * @var value-of<FinalDomState>|null $finalDomState
     */
    #[Optional('finalDOMState', enum: FinalDomState::class)]
    public ?string $finalDomState;

    /**
     * Credit usage, included whenever a valid API key is provided.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new WebWebScrapeScreenshotResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebWebScrapeScreenshotResponse::with(
     *   cacheMetadata: ...,
     *   height: ...,
     *   requestID: ...,
     *   screenshot: ...,
     *   url: ...,
     *   width: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebWebScrapeScreenshotResponse)
     *   ->withCacheMetadata(...)
     *   ->withHeight(...)
     *   ->withRequestID(...)
     *   ->withScreenshot(...)
     *   ->withURL(...)
     *   ->withWidth(...)
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
     * @param CacheMetadata|CacheMetadataShape $cacheMetadata
     * @param FinalDomState|value-of<FinalDomState>|null $finalDomState
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        CacheMetadata|array $cacheMetadata,
        int $height,
        string $requestID,
        string $screenshot,
        string $url,
        int $width,
        FinalDomState|string|null $finalDomState = null,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['cacheMetadata'] = $cacheMetadata;
        $self['height'] = $height;
        $self['requestID'] = $requestID;
        $self['screenshot'] = $screenshot;
        $self['url'] = $url;
        $self['width'] = $width;

        null !== $finalDomState && $self['finalDomState'] = $finalDomState;
        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * Cache outcome for this response. Composite responses are hits only when every cache-controlled fetch contributing to the output was a hit; age_ms is the oldest contributing hit.
     *
     * @param CacheMetadata|CacheMetadataShape $cacheMetadata
     */
    public function withCacheMetadata(CacheMetadata|array $cacheMetadata): self
    {
        $self = clone $this;
        $self['cacheMetadata'] = $cacheMetadata;

        return $self;
    }

    /**
     * Height of the returned image in pixels.
     */
    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Unique id of this API call, also sent in the X-Request-Id response header. Quote it when contacting support about a failed request.
     */
    public function withRequestID(string $requestID): self
    {
        $self = clone $this;
        $self['requestID'] = $requestID;

        return $self;
    }

    /**
     * Public image URL for standard requests, or an in-memory data URL when ZDR or non-empty custom headers are supplied.
     */
    public function withScreenshot(string $screenshot): self
    {
        $self = clone $this;
        $self['screenshot'] = $screenshot;

        return $self;
    }

    /**
     * The requested page URL.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Width of the returned image in pixels.
     */
    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }

    /**
     * How complete the returned content is. `loaded` means the page finished the waits the request asked for. `still-loading` only occurs with timeoutOpts.behavior=return-partial: the timeoutOpts.milliseconds deadline was reached first, so the content reflects the DOM at that moment and late-rendering parts may be missing. Partial results are billed at the base request cost.
     *
     * @param FinalDomState|value-of<FinalDomState> $finalDomState
     */
    public function withFinalDomState(FinalDomState|string $finalDomState): self
    {
        $self = clone $this;
        $self['finalDomState'] = $finalDomState;

        return $self;
    }

    /**
     * Credit usage, included whenever a valid API key is provided.
     *
     * @param KeyMetadata|KeyMetadataShape $keyMetadata
     */
    public function withKeyMetadata(KeyMetadata|array $keyMetadata): self
    {
        $self = clone $this;
        $self['keyMetadata'] = $keyMetadata;

        return $self;
    }
}
