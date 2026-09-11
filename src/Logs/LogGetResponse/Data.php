<?php

declare(strict_types=1);

namespace ContextDev\Logs\LogGetResponse;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Logs\LogGetResponse\Data\Input;
use ContextDev\Logs\LogGetResponse\Data\KeyMetadata;

/**
 * @phpstan-import-type InputShape from \ContextDev\Logs\LogGetResponse\Data\Input
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Logs\LogGetResponse\Data\KeyMetadata
 *
 * @phpstan-type DataShape = array{
 *   creditsUsed: int,
 *   errorCode: string|null,
 *   input: Input|InputShape,
 *   keyID: string|null,
 *   latencyMs: float,
 *   method: string,
 *   path: string,
 *   requestID: string,
 *   statusCode: int,
 *   tags: list<string>,
 *   timestamp: \DateTimeInterface,
 *   userAgent: string|null,
 *   zdr: bool,
 *   keyMetadata?: null|\ContextDev\Logs\LogGetResponse\Data\KeyMetadata|KeyMetadataShape,
 *   response?: mixed,
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
     * What was sent with the request.
     */
    #[Required]
    public Input $input;

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
     * User-Agent header of the request.
     */
    #[Required('user_agent')]
    public ?string $userAgent;

    /**
     * Whether the request was made under zero data retention.
     */
    #[Required]
    public bool $zdr;

    /**
     * Credit usage, included whenever a valid API key is provided.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * The retained JSON response with credentials redacted, or null when unavailable.
     */
    #[Optional]
    public mixed $response;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(
     *   creditsUsed: ...,
     *   errorCode: ...,
     *   input: ...,
     *   keyID: ...,
     *   latencyMs: ...,
     *   method: ...,
     *   path: ...,
     *   requestID: ...,
     *   statusCode: ...,
     *   tags: ...,
     *   timestamp: ...,
     *   userAgent: ...,
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
     *   ->withInput(...)
     *   ->withKeyID(...)
     *   ->withLatencyMs(...)
     *   ->withMethod(...)
     *   ->withPath(...)
     *   ->withRequestID(...)
     *   ->withStatusCode(...)
     *   ->withTags(...)
     *   ->withTimestamp(...)
     *   ->withUserAgent(...)
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
     * @param Input|InputShape $input
     * @param list<string> $tags
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        int $creditsUsed,
        ?string $errorCode,
        Input|array $input,
        ?string $keyID,
        float $latencyMs,
        string $method,
        string $path,
        string $requestID,
        int $statusCode,
        array $tags,
        \DateTimeInterface $timestamp,
        ?string $userAgent,
        bool $zdr,
        KeyMetadata|array|null $keyMetadata = null,
        mixed $response = null,
    ): self {
        $self = new self;

        $self['creditsUsed'] = $creditsUsed;
        $self['errorCode'] = $errorCode;
        $self['input'] = $input;
        $self['keyID'] = $keyID;
        $self['latencyMs'] = $latencyMs;
        $self['method'] = $method;
        $self['path'] = $path;
        $self['requestID'] = $requestID;
        $self['statusCode'] = $statusCode;
        $self['tags'] = $tags;
        $self['timestamp'] = $timestamp;
        $self['userAgent'] = $userAgent;
        $self['zdr'] = $zdr;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $response && $self['response'] = $response;

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
     * What was sent with the request.
     *
     * @param Input|InputShape $input
     */
    public function withInput(Input|array $input): self
    {
        $self = clone $this;
        $self['input'] = $input;

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
     * User-Agent header of the request.
     */
    public function withUserAgent(?string $userAgent): self
    {
        $self = clone $this;
        $self['userAgent'] = $userAgent;

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

    /**
     * Credit usage, included whenever a valid API key is provided.
     *
     * @param KeyMetadata|KeyMetadataShape $keyMetadata
     */
    public function withKeyMetadata(
        KeyMetadata|array $keyMetadata
    ): self {
        $self = clone $this;
        $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * The retained JSON response with credentials redacted, or null when unavailable.
     */
    public function withResponse(mixed $response): self
    {
        $self = clone $this;
        $self['response'] = $response;

        return $self;
    }
}
