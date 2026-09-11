<?php

declare(strict_types=1);

namespace ContextDev\Logs;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Logs\LogListResponse\Data;
use ContextDev\Logs\LogListResponse\KeyMetadata;

/**
 * @phpstan-import-type DataShape from \ContextDev\Logs\LogListResponse\Data
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Logs\LogListResponse\KeyMetadata
 *
 * @phpstan-type LogListResponseShape = array{
 *   data: list<Data|DataShape>,
 *   hasMore: bool,
 *   limit: int,
 *   page: int,
 *   requestID: string,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class LogListResponse implements BaseModel
{
    /** @use SdkModel<LogListResponseShape> */
    use SdkModel;

    /**
     * Log entries, newest first.
     *
     * @var list<Data> $data
     */
    #[Required(list: Data::class)]
    public array $data;

    /**
     * Whether a next page exists.
     */
    #[Required('has_more')]
    public bool $hasMore;

    /**
     * Entries per page.
     */
    #[Required]
    public int $limit;

    /**
     * Current page number.
     */
    #[Required]
    public int $page;

    /**
     * Unique id of this API call, also sent in the X-Request-Id response header. Quote it when contacting support about a failed request.
     */
    #[Required('request_id')]
    public string $requestID;

    /**
     * Credit usage, included whenever a valid API key is provided.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new LogListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LogListResponse::with(
     *   data: ..., hasMore: ..., limit: ..., page: ..., requestID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LogListResponse)
     *   ->withData(...)
     *   ->withHasMore(...)
     *   ->withLimit(...)
     *   ->withPage(...)
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
        int $limit,
        int $page,
        string $requestID,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['data'] = $data;
        $self['hasMore'] = $hasMore;
        $self['limit'] = $limit;
        $self['page'] = $page;
        $self['requestID'] = $requestID;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * Log entries, newest first.
     *
     * @param list<Data|DataShape> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * Whether a next page exists.
     */
    public function withHasMore(bool $hasMore): self
    {
        $self = clone $this;
        $self['hasMore'] = $hasMore;

        return $self;
    }

    /**
     * Entries per page.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Current page number.
     */
    public function withPage(int $page): self
    {
        $self = clone $this;
        $self['page'] = $page;

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
