<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Webhooks\Deliveries\DeliveryListAttemptsResponse\KeyMetadata;

/**
 * @phpstan-import-type AttemptShape from \ContextDev\Webhooks\Deliveries\Attempt
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Webhooks\Deliveries\DeliveryListAttemptsResponse\KeyMetadata
 *
 * @phpstan-type DeliveryListAttemptsResponseShape = array{
 *   data: list<Attempt|AttemptShape>,
 *   hasMore: bool,
 *   nextCursor: string|null,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class DeliveryListAttemptsResponse implements BaseModel
{
    /** @use SdkModel<DeliveryListAttemptsResponseShape> */
    use SdkModel;

    /**
     * Delivery attempts.
     *
     * @var list<Attempt> $data
     */
    #[Required(list: Attempt::class)]
    public array $data;

    /**
     * Whether more attempts are available.
     */
    #[Required('has_more')]
    public bool $hasMore;

    /**
     * Next page cursor, or null on the last page.
     */
    #[Required('next_cursor')]
    public ?string $nextCursor;

    /**
     * Credit usage, included whenever a valid API key is provided.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new DeliveryListAttemptsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeliveryListAttemptsResponse::with(data: ..., hasMore: ..., nextCursor: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DeliveryListAttemptsResponse)
     *   ->withData(...)
     *   ->withHasMore(...)
     *   ->withNextCursor(...)
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
     * @param list<Attempt|AttemptShape> $data
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        array $data,
        bool $hasMore,
        ?string $nextCursor,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['data'] = $data;
        $self['hasMore'] = $hasMore;
        $self['nextCursor'] = $nextCursor;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * Delivery attempts.
     *
     * @param list<Attempt|AttemptShape> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * Whether more attempts are available.
     */
    public function withHasMore(bool $hasMore): self
    {
        $self = clone $this;
        $self['hasMore'] = $hasMore;

        return $self;
    }

    /**
     * Next page cursor, or null on the last page.
     */
    public function withNextCursor(?string $nextCursor): self
    {
        $self = clone $this;
        $self['nextCursor'] = $nextCursor;

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
