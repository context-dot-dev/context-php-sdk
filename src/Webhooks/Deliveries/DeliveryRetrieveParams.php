<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Get the live status, retry policy, latest attempt, and replay expiration for a retained delivery. Use the attempts endpoint for its complete paginated history. This endpoint costs no credits.
 *
 * @see ContextDev\Services\Webhooks\DeliveriesService::retrieve()
 *
 * @phpstan-type DeliveryRetrieveParamsShape = array{tags?: list<string>|null}
 */
final class DeliveryRetrieveParams implements BaseModel
{
    /** @use SdkModel<DeliveryRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
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
    public static function with(?array $tags = null): self
    {
        $self = new self;

        null !== $tags && $self['tags'] = $tags;

        return $self;
    }

    /**
     * Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
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
