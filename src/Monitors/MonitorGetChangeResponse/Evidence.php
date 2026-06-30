<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetChangeResponse;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type EvidenceShape = array{
 *   after: string, before: string, url?: string|null
 * }
 */
final class Evidence implements BaseModel
{
    /** @use SdkModel<EvidenceShape> */
    use SdkModel;

    /**
     * Snapshot of the content after the change.
     */
    #[Required]
    public string $after;

    /**
     * Snapshot of the content before the change.
     */
    #[Required]
    public string $before;

    /**
     * Optional URL the evidence relates to. Absent for whole-target diffs.
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
     * Snapshot of the content after the change.
     */
    public function withAfter(string $after): self
    {
        $self = clone $this;
        $self['after'] = $after;

        return $self;
    }

    /**
     * Snapshot of the content before the change.
     */
    public function withBefore(string $before): self
    {
        $self = clone $this;
        $self['before'] = $before;

        return $self;
    }

    /**
     * Optional URL the evidence relates to. Absent for whole-target diffs.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
