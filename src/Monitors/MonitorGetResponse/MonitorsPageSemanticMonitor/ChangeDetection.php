<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetResponse\MonitorsPageSemanticMonitor;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorGetResponse\MonitorsPageSemanticMonitor\ChangeDetection\Type;

/**
 * Detect meaning-level changes that match a natural language query.
 *
 * @phpstan-type ChangeDetectionShape = array{
 *   query: string, type: Type|value-of<Type>, confidenceThreshold?: float|null
 * }
 */
final class ChangeDetection implements BaseModel
{
    /** @use SdkModel<ChangeDetectionShape> */
    use SdkModel;

    #[Required]
    public string $query;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    #[Optional('confidence_threshold')]
    public ?float $confidenceThreshold;

    /**
     * `new ChangeDetection()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ChangeDetection::with(query: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ChangeDetection)->withQuery(...)->withType(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $query,
        Type|string $type,
        ?float $confidenceThreshold = null
    ): self {
        $self = new self;

        $self['query'] = $query;
        $self['type'] = $type;

        null !== $confidenceThreshold && $self['confidenceThreshold'] = $confidenceThreshold;

        return $self;
    }

    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    public function withConfidenceThreshold(float $confidenceThreshold): self
    {
        $self = clone $this;
        $self['confidenceThreshold'] = $confidenceThreshold;

        return $self;
    }
}
