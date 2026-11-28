<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Resend a delivery's original payload to the source's current webhook URL, signed with its current secret. Available for 7 days after the event.
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
     * Resend even if the delivery already succeeded.
     */
    #[Optional]
    public ?bool $force;

    /**
     * Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Unique key for this retry. Repeating the request with the same key does not send the payload again.
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
     * Resend even if the delivery already succeeded.
     */
    public function withForce(bool $force): self
    {
        $self = clone $this;
        $self['force'] = $force;

        return $self;
    }

    /**
     * Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
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
     * Unique key for this retry. Repeating the request with the same key does not send the payload again.
     */
    public function withIdempotencyKey(string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }
}
