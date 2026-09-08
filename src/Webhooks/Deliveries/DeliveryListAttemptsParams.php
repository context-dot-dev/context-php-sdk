<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * List delivery attempts, newest first.
 *
 * @see ContextDev\Services\Webhooks\DeliveriesService::listAttempts()
 *
 * @phpstan-type DeliveryListAttemptsParamsShape = array{
 *   cursor?: string|null, limit?: int|null, tags?: list<string>|null
 * }
 */
final class DeliveryListAttemptsParams implements BaseModel
{
    /** @use SdkModel<DeliveryListAttemptsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The next_cursor from the previous response.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Number of attempts to return.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Comma-separated tags for tracking request usage. Up to 20 tags, each 1-50 characters.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

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
        ?string $cursor = null,
        ?int $limit = null,
        ?array $tags = null
    ): self {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;
        null !== $tags && $self['tags'] = $tags;

        return $self;
    }

    /**
     * The next_cursor from the previous response.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Number of attempts to return.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Comma-separated tags for tracking request usage. Up to 20 tags, each 1-50 characters.
     *
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }
}
