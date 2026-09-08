<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Webhooks\Deliveries\DeliveryListResponse\KeyMetadata;

/**
 * @phpstan-import-type DeliverySummaryShape from \ContextDev\Webhooks\Deliveries\DeliverySummary
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Webhooks\Deliveries\DeliveryListResponse\KeyMetadata
 *
 * @phpstan-type DeliveryListResponseShape = array{
 *   data: list<DeliverySummary|DeliverySummaryShape>,
 *   hasMore: bool,
 *   nextCursor: string|null,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class DeliveryListResponse implements BaseModel
{
    /** @use SdkModel<DeliveryListResponseShape> */
    use SdkModel;

    /**
     * Webhook deliveries.
     *
     * @var list<DeliverySummary> $data
     */
    #[Required(list: DeliverySummary::class)]
    public array $data;

    /**
     * Whether more deliveries are available.
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
     * `new DeliveryListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeliveryListResponse::with(data: ..., hasMore: ..., nextCursor: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DeliveryListResponse)->withData(...)->withHasMore(...)->withNextCursor(...)
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
     * @param list<DeliverySummary|DeliverySummaryShape> $data
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
     * Webhook deliveries.
     *
     * @param list<DeliverySummary|DeliverySummaryShape> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * Whether more deliveries are available.
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
