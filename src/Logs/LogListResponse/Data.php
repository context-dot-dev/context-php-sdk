<?php

declare(strict_types=1);

namespace ContextDev\Logs\LogListResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type DataShape = array{
 *   creditsUsed: int,
 *   errorCode: string|null,
 *   keyID: string|null,
 *   latencyMs: float,
 *   method: string,
 *   path: string,
 *   requestID: string,
 *   statusCode: int,
 *   tags: list<string>,
 *   timestamp: \DateTimeInterface,
 *   zdr: bool,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Credits charged for this request.
     */
    #[Required('credits_used')]
    public int $creditsUsed;

    /**
     * The `error_code` from the response, or null on success.
     */
    #[Required('error_code')]
    public ?string $errorCode;

    /**
     * ID of the API key that made the request.
     */
    #[Required('key_id')]
    public ?string $keyID;

    /**
     * Server-side processing time in milliseconds.
     */
    #[Required('latency_ms')]
    public float $latencyMs;

    /**
     * HTTP method.
     */
    #[Required]
    public string $method;

    /**
     * Endpoint path as called.
     */
    #[Required]
    public string $path;

    /**
     * Request ID of the logged API call.
     */
    #[Required('request_id')]
    public string $requestID;

    /**
     * HTTP status code returned.
     */
    #[Required('status_code')]
    public int $statusCode;

    /**
     * Request tags supplied by the caller.
     *
     * @var list<string> $tags
     */
    #[Required(list: 'string')]
    public array $tags;

    /**
     * When the request completed.
     */
    #[Required]
    public \DateTimeInterface $timestamp;

    /**
     * Whether the request was made under zero data retention.
     */
    #[Required]
    public bool $zdr;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(
     *   creditsUsed: ...,
     *   errorCode: ...,
     *   keyID: ...,
     *   latencyMs: ...,
     *   method: ...,
     *   path: ...,
     *   requestID: ...,
     *   statusCode: ...,
     *   tags: ...,
     *   timestamp: ...,
     *   zdr: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)
     *   ->withCreditsUsed(...)
     *   ->withErrorCode(...)
     *   ->withKeyID(...)
     *   ->withLatencyMs(...)
     *   ->withMethod(...)
     *   ->withPath(...)
     *   ->withRequestID(...)
     *   ->withStatusCode(...)
     *   ->withTags(...)
     *   ->withTimestamp(...)
     *   ->withZdr(...)
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
     * @param list<string> $tags
     */
    public static function with(
        int $creditsUsed,
        ?string $errorCode,
        ?string $keyID,
        float $latencyMs,
        string $method,
        string $path,
        string $requestID,
        int $statusCode,
        array $tags,
        \DateTimeInterface $timestamp,
        bool $zdr,
    ): self {
        $self = new self;

        $self['creditsUsed'] = $creditsUsed;
        $self['errorCode'] = $errorCode;
        $self['keyID'] = $keyID;
        $self['latencyMs'] = $latencyMs;
        $self['method'] = $method;
        $self['path'] = $path;
        $self['requestID'] = $requestID;
        $self['statusCode'] = $statusCode;
        $self['tags'] = $tags;
        $self['timestamp'] = $timestamp;
        $self['zdr'] = $zdr;

        return $self;
    }

    /**
     * Credits charged for this request.
     */
    public function withCreditsUsed(int $creditsUsed): self
    {
        $self = clone $this;
        $self['creditsUsed'] = $creditsUsed;

        return $self;
    }

    /**
     * The `error_code` from the response, or null on success.
     */
    public function withErrorCode(?string $errorCode): self
    {
        $self = clone $this;
        $self['errorCode'] = $errorCode;

        return $self;
    }

    /**
     * ID of the API key that made the request.
     */
    public function withKeyID(?string $keyID): self
    {
        $self = clone $this;
        $self['keyID'] = $keyID;

        return $self;
    }

    /**
     * Server-side processing time in milliseconds.
     */
    public function withLatencyMs(float $latencyMs): self
    {
        $self = clone $this;
        $self['latencyMs'] = $latencyMs;

        return $self;
    }

    /**
     * HTTP method.
     */
    public function withMethod(string $method): self
    {
        $self = clone $this;
        $self['method'] = $method;

        return $self;
    }

    /**
     * Endpoint path as called.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }

    /**
     * Request ID of the logged API call.
     */
    public function withRequestID(string $requestID): self
    {
        $self = clone $this;
        $self['requestID'] = $requestID;

        return $self;
    }

    /**
     * HTTP status code returned.
     */
    public function withStatusCode(int $statusCode): self
    {
        $self = clone $this;
        $self['statusCode'] = $statusCode;

        return $self;
    }

    /**
     * Request tags supplied by the caller.
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
     * When the request completed.
     */
    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $self = clone $this;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    /**
     * Whether the request was made under zero data retention.
     */
    public function withZdr(bool $zdr): self
    {
        $self = clone $this;
        $self['zdr'] = $zdr;

        return $self;
    }
}
