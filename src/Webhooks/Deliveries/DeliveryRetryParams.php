<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Retry a webhook delivery within seven days of creation.
 *
 * @see ContextDev\Services\Webhooks\DeliveriesService::retry()
 *
 * @phpstan-type DeliveryRetryParamsShape = array{
 *   force?: bool|null, tags?: list<string>|null, idempotencyKey?: string|null
 * }
 */
final class DeliveryRetryParams implements BaseModel
{
    /** @use SdkModel<DeliveryRetryParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Resend a delivery that already succeeded.
     */
    #[Optional]
    public ?bool $force;

    /**
     * Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Unique key to prevent duplicate retry requests.
     */
    #[Optional]
    public ?string $idempotencyKey;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $tags
     */
    public static function with(
        ?bool $force = null,
        ?array $tags = null,
        ?string $idempotencyKey = null
    ): self {
        $self = new self;

        null !== $force && $self['force'] = $force;
        null !== $tags && $self['tags'] = $tags;
        null !== $idempotencyKey && $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }

    /**
     * Resend a delivery that already succeeded.
     */
    public function withForce(bool $force): self
    {
        $self = clone $this;
        $self['force'] = $force;

        return $self;
    }

    /**
     * Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
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
     * Unique key to prevent duplicate retry requests.
     */
    public function withIdempotencyKey(string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }
}
