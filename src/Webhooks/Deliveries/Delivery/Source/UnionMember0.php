<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries\Delivery\Source;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Webhooks\Deliveries\Delivery\Source\UnionMember0\Type;

/**
 * @phpstan-type UnionMember0Shape = array{
 *   batchID: string, type: Type|value-of<Type>
 * }
 */
final class UnionMember0 implements BaseModel
{
    /** @use SdkModel<UnionMember0Shape> */
    use SdkModel;

    #[Required('batch_id')]
    public string $batchID;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new UnionMember0()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember0::with(batchID: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnionMember0)->withBatchID(...)->withType(...)
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

    public function withBatchID(string $batchID): self
    {
        $self = clone $this;
        $self['batchID'] = $batchID;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
