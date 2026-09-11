<?php

declare(strict_types=1);

namespace ContextDev\Batch;

use ContextDev\Batch\BatchGetResultsResponse\Data;
use ContextDev\Batch\BatchGetResultsResponse\KeyMetadata;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type DataVariants from \ContextDev\Batch\BatchGetResultsResponse\Data
 * @phpstan-import-type DataShape from \ContextDev\Batch\BatchGetResultsResponse\Data
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Batch\BatchGetResultsResponse\KeyMetadata
 *
 * @phpstan-type BatchGetResultsResponseShape = array{
 *   requestID: string,
 *   data?: list<DataShape>|null,
 *   hasMore?: bool|null,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   nextCursor?: string|null,
 * }
 */
final class BatchGetResultsResponse implements BaseModel
{
    /** @use SdkModel<BatchGetResultsResponseShape> */
    use SdkModel;

    /**
     * Unique id of this API call, also sent in the X-Request-Id response header. Quote it when contacting support about a failed request.
     */
    #[Required('request_id')]
    public string $requestID;

    /**
     * Result records on this page.
     *
     * @var list<DataVariants>|null $data
     */
    #[Optional(list: Data::class)]
    public ?array $data;

    /**
     * Whether another page is available.
     */
    #[Optional('has_more')]
    public ?bool $hasMore;

    /**
     * Credit usage, included whenever a valid API key is provided.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * Cursor for the next page.
     */
    #[Optional('next_cursor', nullable: true)]
    public ?string $nextCursor;

    /**
     * `new BatchGetResultsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BatchGetResultsResponse::with(requestID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BatchGetResultsResponse)->withRequestID(...)
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
     * @param list<DataShape>|null $data
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        string $requestID,
        ?array $data = null,
        ?bool $hasMore = null,
        KeyMetadata|array|null $keyMetadata = null,
        ?string $nextCursor = null,
    ): self {
        $self = new self;

        $self['requestID'] = $requestID;

        null !== $data && $self['data'] = $data;
        null !== $hasMore && $self['hasMore'] = $hasMore;
        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $nextCursor && $self['nextCursor'] = $nextCursor;

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
     * Result records on this page.
     *
     * @param list<DataShape> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * Whether another page is available.
     */
    public function withHasMore(bool $hasMore): self
    {
        $self = clone $this;
        $self['hasMore'] = $hasMore;

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

    /**
     * Cursor for the next page.
     */
    public function withNextCursor(?string $nextCursor): self
    {
        $self = clone $this;
        $self['nextCursor'] = $nextCursor;

        return $self;
    }
}
