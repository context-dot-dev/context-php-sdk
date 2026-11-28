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
     * Cache status of this response.
     */
    #[Required('cache_metadata')]
    public CacheMetadata $cacheMetadata;

    /**
     * Unique ID of this request, also in `X-Request-Id`. Include it when contacting support.
     */
    #[Required('request_id')]
    public string $requestID;

    /**
     * HTTP status code, repeated in the body.
     */
    #[Optional]
    public ?int $code;

    /**
     * Normalized domain that was captured.
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
     * Height of the returned image, in pixels.
     */
    #[Optional]
    public ?int $height;

    /**
     * Credits this request used and your remaining balance.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * URL of the screenshot image. A data URL instead when `zdr` is `enabled` or `headers` are sent.
     */
    #[Optional]
    public ?string $screenshot;

    /**
     * Whether the image covers the viewport or the full page.
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
     * Width of the returned image, in pixels.
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
     * Cache status of this response.
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
     * HTTP status code, repeated in the body.
     */
    public function withCode(int $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * Normalized domain that was captured.
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
     * Height of the returned image, in pixels.
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
     * URL of the screenshot image. A data URL instead when `zdr` is `enabled` or `headers` are sent.
     */
    public function withScreenshot(string $screenshot): self
    {
        $self = clone $this;
        $self['screenshot'] = $screenshot;

        return $self;
    }

    /**
     * Whether the image covers the viewport or the full page.
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
     * Width of the returned image, in pixels.
     */
    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
