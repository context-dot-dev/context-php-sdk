<?php

declare(strict_types=1);

namespace ContextDev\Batch;

use ContextDev\Batch\BatchDeleteResponse\KeyMetadata;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Batch\BatchDeleteResponse\KeyMetadata
 *
 * @phpstan-type BatchDeleteResponseShape = array{
 *   requestID: string,
 *   id?: string|null,
 *   deleted?: bool|null,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class BatchDeleteResponse implements BaseModel
{
    /** @use SdkModel<BatchDeleteResponseShape> */
    use SdkModel;

    /**
     * Unique id of this API call, also sent in the X-Request-Id response header. Quote it when contacting support about a failed request.
     */
    #[Required('request_id')]
    public string $requestID;

    /**
     * ID of the deleted batch.
     */
    #[Optional]
    public ?string $id;

    /**
     * Always true on success.
     */
    #[Optional]
    public ?bool $deleted;

    /**
     * Credit usage, included whenever a valid API key is provided.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new BatchDeleteResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BatchDeleteResponse::with(requestID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BatchDeleteResponse)->withRequestID(...)
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
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        string $requestID,
        ?string $id = null,
        ?bool $deleted = null,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['requestID'] = $requestID;

        null !== $id && $self['id'] = $id;
        null !== $deleted && $self['deleted'] = $deleted;
        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

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
     * ID of the deleted batch.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Always true on success.
     */
    public function withDeleted(bool $deleted): self
    {
        $self = clone $this;
        $self['deleted'] = $deleted;

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
