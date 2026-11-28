<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetChangeResponse;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Before and after excerpts that support a change.
 *
 * @phpstan-type EvidenceShape = array{
 *   after: string, before: string, url?: string|null
 * }
 */
final class Evidence implements BaseModel
{
    /** @use SdkModel<EvidenceShape> */
    use SdkModel;

    /**
     * Content after the change.
     */
    #[Required]
    public string $after;

    /**
     * Content before the change. Empty for new search results.
     */
    #[Required]
    public string $before;

    /**
     * Page the evidence comes from. Omitted when the evidence covers the whole target.
     */
    #[Optional]
    public ?string $url;

    /**
     * `new Evidence()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Evidence::with(after: ..., before: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Evidence)->withAfter(...)->withBefore(...)
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
     */
    public static function with(
        string $after,
        string $before,
        ?string $url = null
    ): self {
        $self = new self;

        $self['after'] = $after;
        $self['before'] = $before;

        null !== $url && $self['url'] = $url;

        return $self;
    }

    /**
     * Content after the change.
     */
    public function withAfter(string $after): self
    {
        $self = clone $this;
        $self['after'] = $after;

        return $self;
    }

    /**
     * Content before the change. Empty for new search results.
     */
    public function withBefore(string $before): self
    {
        $self = clone $this;
        $self['before'] = $before;

        return $self;
    }

    /**
     * Page the evidence comes from. Omitted when the evidence covers the whole target.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
