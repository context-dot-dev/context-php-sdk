<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetChangeResponse\MonitorsPageSemanticChange;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type EvidenceShape = array{after: string, before: string}
 */
final class Evidence implements BaseModel
{
    /** @use SdkModel<EvidenceShape> */
    use SdkModel;

    #[Required]
    public string $after;

    #[Required]
    public string $before;

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
    public static function with(string $after, string $before): self
    {
        $self = new self;

        $self['after'] = $after;
        $self['before'] = $before;

        return $self;
    }

    public function withAfter(string $after): self
    {
        $self = clone $this;
        $self['after'] = $after;

        return $self;
    }

    public function withBefore(string $before): self
    {
        $self = clone $this;
        $self['before'] = $before;

        return $self;
    }
}
