<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Webhooks\Deliveries\DeliveryRetryResponse\KeyMetadata;

/**
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Webhooks\Deliveries\DeliveryRetryResponse\KeyMetadata
 *
 * @phpstan-type DeliveryRetryResponseShape = array{
 *   id: string, keyMetadata?: null|KeyMetadata|KeyMetadataShape
 * }
 */
final class DeliveryRetryResponse implements BaseModel
{
    /** @use SdkModel<DeliveryRetryResponseShape> */
    use SdkModel;

    /**
     * Delivery ID.
     */
    #[Required]
    public string $id;

    /**
     * Credit usage, included whenever a valid API key is provided.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new DeliveryRetryResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeliveryRetryResponse::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DeliveryRetryResponse)->withID(...)
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
        string $id,
        KeyMetadata|array|null $keyMetadata = null
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * Delivery ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

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
