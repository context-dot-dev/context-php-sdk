<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Resend the original payload using the source’s current URL and secret. Available for 7 days after the event.
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
     * Resend even if the delivery already succeeded. Defaults to false.
     */
    #[Optional]
    public ?bool $force;

    /**
     * Labels for filtering usage in the dashboard.
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
     * Resend even if the delivery already succeeded. Defaults to false.
     */
    public function withForce(bool $force): self
    {
        $self = clone $this;
        $self['force'] = $force;

        return $self;
    }

    /**
     * Labels for filtering usage in the dashboard.
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
