<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorListRunsResponse\Data;
use ContextDev\Monitors\MonitorListRunsResponse\KeyMetadata;

/**
 * @phpstan-import-type DataShape from \ContextDev\Monitors\MonitorListRunsResponse\Data
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Monitors\MonitorListRunsResponse\KeyMetadata
 *
 * @phpstan-type MonitorListRunsResponseShape = array{
 *   data: list<Data|DataShape>,
 *   hasMore: bool,
 *   nextCursor: string|null,
 *   requestID: string,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class MonitorListRunsResponse implements BaseModel
{
    /** @use SdkModel<MonitorListRunsResponseShape> */
    use SdkModel;

    /** @var list<Data> $data */
    #[Required(list: Data::class)]
    public array $data;

    #[Required('has_more')]
    public bool $hasMore;

    #[Required('next_cursor')]
    public ?string $nextCursor;

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
     * `new MonitorListRunsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorListRunsResponse::with(
     *   data: ..., hasMore: ..., nextCursor: ..., requestID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MonitorListRunsResponse)
     *   ->withData(...)
     *   ->withHasMore(...)
     *   ->withNextCursor(...)
     *   ->withRequestID(...)
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
     * @param list<Data|DataShape> $data
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        array $data,
        bool $hasMore,
        ?string $nextCursor,
        string $requestID,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['data'] = $data;
        $self['hasMore'] = $hasMore;
        $self['nextCursor'] = $nextCursor;
        $self['requestID'] = $requestID;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * @param list<Data|DataShape> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    public function withHasMore(bool $hasMore): self
    {
        $self = clone $this;
        $self['hasMore'] = $hasMore;

        return $self;
    }

    public function withNextCursor(?string $nextCursor): self
    {
        $self = clone $this;
        $self['nextCursor'] = $nextCursor;

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
