<?php

declare(strict_types=1);

namespace ContextDev\Batch;

use ContextDev\Batch\BatchDeleteResponse\KeyMetadata;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Batch\BatchDeleteResponse\KeyMetadata
 *
 * @phpstan-type BatchDeleteResponseShape = array{
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
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

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
        ?string $id = null,
        ?bool $deleted = null,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $deleted && $self['deleted'] = $deleted;
        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

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
}
