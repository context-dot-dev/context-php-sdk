<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebScrapeBytesResponse\Encoding;
use ContextDev\Web\WebWebScrapeBytesResponse\KeyMetadata;

/**
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Web\WebWebScrapeBytesResponse\KeyMetadata
 *
 * @phpstan-type WebWebScrapeBytesResponseShape = array{
 *   bytes: string,
 *   contentLength: int,
 *   contentType: string,
 *   encoding: Encoding|value-of<Encoding>,
 *   finalURL: string,
 *   requestID: string,
 *   statusCode: int,
 *   success: bool,
 *   url: string,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class WebWebScrapeBytesResponse implements BaseModel
{
    /** @use SdkModel<WebWebScrapeBytesResponseShape> */
    use SdkModel;

    /**
     * Base64-encoded resource bytes, without a data URI prefix. Decode this field to recover the downloaded file.
     */
    #[Required]
    public string $bytes;

    /**
     * Number of decoded resource bytes, before base64 encoding.
     */
    #[Required]
    public int $contentLength;

    /**
     * The Content-Type returned by the origin, including any charset. Defaults to application/octet-stream when absent.
     */
    #[Required]
    public string $contentType;

    /** @var value-of<Encoding> $encoding */
    #[Required(enum: Encoding::class)]
    public string $encoding;

    /**
     * The resource URL after redirects.
     */
    #[Required('finalUrl')]
    public string $finalURL;

    /**
     * Unique id of this API call, also sent in the X-Request-Id response header. Quote it when contacting support about a failed request.
     */
    #[Required('request_id')]
    public string $requestID;

    /**
     * HTTP status returned by the origin.
     */
    #[Required]
    public int $statusCode;

    #[Required]
    public bool $success;

    /**
     * The requested resource URL.
     */
    #[Required]
    public string $url;

    /**
     * Credit usage, included whenever a valid API key is provided.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new WebWebScrapeBytesResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebWebScrapeBytesResponse::with(
     *   bytes: ...,
     *   contentLength: ...,
     *   contentType: ...,
     *   encoding: ...,
     *   finalURL: ...,
     *   requestID: ...,
     *   statusCode: ...,
     *   success: ...,
     *   url: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebWebScrapeBytesResponse)
     *   ->withBytes(...)
     *   ->withContentLength(...)
     *   ->withContentType(...)
     *   ->withEncoding(...)
     *   ->withFinalURL(...)
     *   ->withRequestID(...)
     *   ->withStatusCode(...)
     *   ->withSuccess(...)
     *   ->withURL(...)
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
     * @param Encoding|value-of<Encoding> $encoding
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        string $bytes,
        int $contentLength,
        string $contentType,
        Encoding|string $encoding,
        string $finalURL,
        string $requestID,
        int $statusCode,
        bool $success,
        string $url,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['bytes'] = $bytes;
        $self['contentLength'] = $contentLength;
        $self['contentType'] = $contentType;
        $self['encoding'] = $encoding;
        $self['finalURL'] = $finalURL;
        $self['requestID'] = $requestID;
        $self['statusCode'] = $statusCode;
        $self['success'] = $success;
        $self['url'] = $url;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * Base64-encoded resource bytes, without a data URI prefix. Decode this field to recover the downloaded file.
     */
    public function withBytes(string $bytes): self
    {
        $self = clone $this;
        $self['bytes'] = $bytes;

        return $self;
    }

    /**
     * Number of decoded resource bytes, before base64 encoding.
     */
    public function withContentLength(int $contentLength): self
    {
        $self = clone $this;
        $self['contentLength'] = $contentLength;

        return $self;
    }

    /**
     * The Content-Type returned by the origin, including any charset. Defaults to application/octet-stream when absent.
     */
    public function withContentType(string $contentType): self
    {
        $self = clone $this;
        $self['contentType'] = $contentType;

        return $self;
    }

    /**
     * @param Encoding|value-of<Encoding> $encoding
     */
    public function withEncoding(Encoding|string $encoding): self
    {
        $self = clone $this;
        $self['encoding'] = $encoding;

        return $self;
    }

    /**
     * The resource URL after redirects.
     */
    public function withFinalURL(string $finalURL): self
    {
        $self = clone $this;
        $self['finalURL'] = $finalURL;

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
     * HTTP status returned by the origin.
     */
    public function withStatusCode(int $statusCode): self
    {
        $self = clone $this;
        $self['statusCode'] = $statusCode;

        return $self;
    }

    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }

    /**
     * The requested resource URL.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

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
