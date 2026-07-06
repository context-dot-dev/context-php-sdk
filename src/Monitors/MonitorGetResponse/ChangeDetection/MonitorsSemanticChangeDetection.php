<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetResponse\ChangeDetection;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Detect meaning-level changes that match a natural language query.
 *
 * @phpstan-type MonitorsSemanticChangeDetectionShape = array{
 *   query: string, type: 'semantic', confidenceThreshold?: float|null
 * }
 */
final class MonitorsSemanticChangeDetection implements BaseModel
{
    /** @use SdkModel<MonitorsSemanticChangeDetectionShape> */
    use SdkModel;

    /** @var 'semantic' $type */
    #[Required]
    public string $type = 'semantic';

    #[Required]
    public string $query;

    #[Optional('confidence_threshold')]
    public ?float $confidenceThreshold;

    /**
     * `new MonitorsSemanticChangeDetection()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorsSemanticChangeDetection::with(query: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MonitorsSemanticChangeDetection)->withQuery(...)
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
        string $query,
        ?float $confidenceThreshold = null
    ): self {
        $self = new self;

        $self['query'] = $query;

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
     * @param 'semantic' $type
     */
    public function withType(string $type): self
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
