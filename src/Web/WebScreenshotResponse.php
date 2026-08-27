<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScreenshotResponse\CacheMetadata;
use ContextDev\Web\WebScreenshotResponse\KeyMetadata;
use ContextDev\Web\WebScreenshotResponse\ScreenshotType;

/**
 * @phpstan-import-type CacheMetadataShape from \ContextDev\Web\WebScreenshotResponse\CacheMetadata
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Web\WebScreenshotResponse\KeyMetadata
 *
 * @phpstan-type WebScreenshotResponseShape = array{
 *   cacheMetadata: CacheMetadata|CacheMetadataShape,
 *   code?: int|null,
 *   domain?: string|null,
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
     * Cache outcome for this response. Composite responses are hits only when every cache-controlled fetch contributing to the output was a hit; age_ms is the oldest contributing hit.
     */
    #[Required('cache_metadata')]
    public CacheMetadata $cacheMetadata;

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
     * Height in pixels of the returned screenshot image.
     */
    #[Optional]
    public ?int $height;

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * Public image URL for standard requests, or an in-memory data URL when ZDR is enabled.
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
     * Status of the response, e.g., 'ok'.
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
     * WebScreenshotResponse::with(cacheMetadata: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebScreenshotResponse)->withCacheMetadata(...)
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
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     * @param ScreenshotType|value-of<ScreenshotType>|null $screenshotType
     */
    public static function with(
        CacheMetadata|array $cacheMetadata,
        ?int $code = null,
        ?string $domain = null,
        ?int $height = null,
        KeyMetadata|array|null $keyMetadata = null,
        ?string $screenshot = null,
        ScreenshotType|string|null $screenshotType = null,
        ?string $status = null,
        ?int $width = null,
    ): self {
        $self = new self;

        $self['cacheMetadata'] = $cacheMetadata;

        null !== $code && $self['code'] = $code;
        null !== $domain && $self['domain'] = $domain;
        null !== $height && $self['height'] = $height;
        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $screenshot && $self['screenshot'] = $screenshot;
        null !== $screenshotType && $self['screenshotType'] = $screenshotType;
        null !== $status && $self['status'] = $status;
        null !== $width && $self['width'] = $width;

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
     * Height in pixels of the returned screenshot image.
     */
    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
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
     * Public image URL for standard requests, or an in-memory data URL when ZDR is enabled.
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
     * Status of the response, e.g., 'ok'.
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
