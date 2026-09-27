<?php

declare(strict_types=1);

namespace ContextDev\Logs;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Logs\LogGetResponse\Data;
use ContextDev\Logs\LogGetResponse\KeyMetadata;

/**
 * @phpstan-import-type DataShape from \ContextDev\Logs\LogGetResponse\Data
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Logs\LogGetResponse\KeyMetadata
 *
 * @phpstan-type LogGetResponseShape = array{
 *   data: Data|DataShape,
 *   requestID: string,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class LogGetResponse implements BaseModel
{
    /** @use SdkModel<LogGetResponseShape> */
    use SdkModel;

    #[Required]
    public Data $data;

    /**
     * Unique ID of this request, also in `X-Request-Id`. Include it when contacting support.
     */
    #[Required('request_id')]
    public string $requestID;

    /**
     * Credits this request used and your remaining balance.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new LogGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LogGetResponse::with(data: ..., requestID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LogGetResponse)->withData(...)->withRequestID(...)
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
     * @param Data|DataShape $data
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        Data|array $data,
        string $requestID,
        KeyMetadata|array|null $keyMetadata = null
    ): self {
        $self = new self;

        $self['data'] = $data;
        $self['requestID'] = $requestID;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * @param Data|DataShape $data
     */
    public function withData(Data|array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

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
}
