<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Queue an immediate attempt without rerunning or billing the underlying batch or monitor. A waiting retry is brought forward. A failed delivery gets one additional attempt without restarting its automatic retry budget. Set force: true to resend an acknowledged delivery. An in-progress attempt cannot be duplicated. The stored event body, event ID, and creation time remain unchanged; each attempt receives a fresh signature. Monitor retries use the current URL and secret; removing the webhook cancels pending deliveries. Batch result URLs in old payloads may have expired: retrieve the batch to get fresh URLs. Replay is available for seven days. A successful attempt cancels remaining automatic retries. Idempotency-Key is scoped to your organization and retained with the delivery metadata; repeating the same key and input returns the original accepted response.
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

    #[Optional]
    public ?bool $force;

    /**
     * Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

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

    public function withIdempotencyKey(string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }
}
