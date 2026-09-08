<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries\DeliverySummary\Source;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Webhooks\Deliveries\DeliverySummary\Source\Batch\Type;

/**
 * @phpstan-type BatchShape = array{batchID: string, type: Type|value-of<Type>}
 */
final class Batch implements BaseModel
{
    /** @use SdkModel<BatchShape> */
    use SdkModel;

    /**
     * Batch ID.
     */
    #[Required('batch_id')]
    public string $batchID;

    /**
     * Delivery source.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new Batch()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Batch::with(batchID: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Batch)->withBatchID(...)->withType(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(string $batchID, Type|string $type): self
    {
        $self = new self;

        $self['batchID'] = $batchID;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Batch ID.
     */
    public function withBatchID(string $batchID): self
    {
        $self = clone $this;
        $self['batchID'] = $batchID;

        return $self;
    }

    /**
     * Delivery source.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
