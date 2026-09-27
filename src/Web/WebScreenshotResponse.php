<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScreenshotResponse\CacheMetadata;
use ContextDev\Web\WebScreenshotResponse\FinalDomState;
use ContextDev\Web\WebScreenshotResponse\KeyMetadata;
use ContextDev\Web\WebScreenshotResponse\ScreenshotType;

/**
 * @phpstan-import-type CacheMetadataShape from \ContextDev\Web\WebScreenshotResponse\CacheMetadata
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Web\WebScreenshotResponse\KeyMetadata
 *
 * @phpstan-type WebScreenshotResponseShape = array{
 *   cacheMetadata: CacheMetadata|CacheMetadataShape,
 *   requestID: string,
 *   code?: int|null,
 *   domain?: string|null,
 *   finalDomState?: null|FinalDomState|value-of<FinalDomState>,
 *   height?: int|null,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   screenshot?: string|null,
 *   screenshotType?: null|ScreenshotType|value-of<ScreenshotType>,
 *   status?: string|null,
 *   width?: int|null,
 * }
 */
final class WebScreenshotResponse implements BaseModel
{
    /** @use SdkModel<WebScreenshotResponseShape> */
    use SdkModel;

    /**
     * Whether this response came from cache.
     */
    #[Required('cache_metadata')]
    public CacheMetadata $cacheMetadata;

    /**
     * Unique ID of this request, also in `X-Request-Id`. Include it when contacting support.
     */
    #[Required('request_id')]
    public string $requestID;

    /**
     * HTTP status code.
     */
    #[Optional]
    public ?int $code;

    /**
     * The normalized domain that was processed.
     */
    #[Optional]
    public ?string $domain;

    /**
     * `loaded`, or `still-loading` when capture ended before the page finished loading.
     *
     * @var value-of<FinalDomState>|null $finalDomState
     */
    #[Optional('finalDOMState', enum: FinalDomState::class)]
    public ?string $finalDomState;

    /**
     * Height in pixels of the returned screenshot image.
     */
    #[Optional]
    public ?int $height;

    /**
     * Credits this request used and your remaining balance.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * Public image URL for standard requests, or an in-memory data URL when ZDR or non-empty custom headers are supplied.
     */
    #[Optional]
    public ?string $screenshot;

    /**
     * Type of screenshot that was captured.
     *
     * @var value-of<ScreenshotType>|null $screenshotType
     */
    #[Optional(enum: ScreenshotType::class)]
    public ?string $screenshotType;

    /**
     * Always `ok` on success.
     */
    #[Optional]
    public ?string $status;

    /**
     * Width in pixels of the returned screenshot image.
     */
    #[Optional]
    public ?int $width;

    /**
     * `new WebScreenshotResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebScreenshotResponse::with(cacheMetadata: ..., requestID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebScreenshotResponse)->withCacheMetadata(...)->withRequestID(...)
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
     * @param ScreenshotType|value-of<ScreenshotType>|null $screenshotType
     */
    public static function with(
        CacheMetadata|array $cacheMetadata,
        string $requestID,
        ?int $code = null,
        ?string $domain = null,
        FinalDomState|string|null $finalDomState = null,
        ?int $height = null,
        KeyMetadata|array|null $keyMetadata = null,
        ?string $screenshot = null,
        ScreenshotType|string|null $screenshotType = null,
        ?string $status = null,
        ?int $width = null,
    ): self {
        $self = new self;

        $self['cacheMetadata'] = $cacheMetadata;
        $self['requestID'] = $requestID;

        null !== $code && $self['code'] = $code;
        null !== $domain && $self['domain'] = $domain;
        null !== $finalDomState && $self['finalDomState'] = $finalDomState;
        null !== $height && $self['height'] = $height;
        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $screenshot && $self['screenshot'] = $screenshot;
        null !== $screenshotType && $self['screenshotType'] = $screenshotType;
        null !== $status && $self['status'] = $status;
        null !== $width && $self['width'] = $width;

        return $self;
    }

    /**
     * Whether this response came from cache.
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
     * Unique ID of this request, also in `X-Request-Id`. Include it when contacting support.
     */
    public function withRequestID(string $requestID): self
    {
        $self = clone $this;
        $self['requestID'] = $requestID;

        return $self;
    }

    /**
     * HTTP status code.
     */
    public function withCode(int $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * The normalized domain that was processed.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * `loaded`, or `still-loading` when capture ended before the page finished loading.
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
     * Height in pixels of the returned screenshot image.
     */
    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Credits this request used and your remaining balance.
     *
     * @param KeyMetadata|KeyMetadataShape $keyMetadata
     */
    public function withKeyMetadata(KeyMetadata|array $keyMetadata): self
    {
        $self = clone $this;
        $self['keyMetadata'] = $keyMetadata;

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
     * Type of screenshot that was captured.
     *
     * @param ScreenshotType|value-of<ScreenshotType> $screenshotType
     */
    public function withScreenshotType(
        ScreenshotType|string $screenshotType
    ): self {
        $self = clone $this;
        $self['screenshotType'] = $screenshotType;

        return $self;
    }

    /**
     * Always `ok` on success.
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Width in pixels of the returned screenshot image.
     */
    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
