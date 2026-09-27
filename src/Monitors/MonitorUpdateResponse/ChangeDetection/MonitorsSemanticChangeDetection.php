<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorUpdateResponse\ChangeDetection;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Detect meaningful content changes using the target’s instructions and optional schema.
 *
 * @phpstan-type MonitorsSemanticChangeDetectionShape = array{
 *   type: 'semantic', confidenceThreshold?: float|null
 * }
 */
final class MonitorsSemanticChangeDetection implements BaseModel
{
    /** @use SdkModel<MonitorsSemanticChangeDetectionShape> */
    use SdkModel;

    /**
     * Use `semantic` to judge changes against the target instructions.
     *
     * @var 'semantic' $type
     */
    #[Required]
    public string $type = 'semantic';

    /**
     * Minimum confidence required to report a meaningful change, from 0 to 1.
     */
    #[Optional('confidence_threshold')]
    public ?float $confidenceThreshold;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?float $confidenceThreshold = null): self
    {
        $self = new self;

        null !== $confidenceThreshold && $self['confidenceThreshold'] = $confidenceThreshold;

        return $self;
    }

    /**
     * Use `semantic` to judge changes against the target instructions.
     *
     * @param 'semantic' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Minimum confidence required to report a meaningful change, from 0 to 1.
     */
    public function withConfidenceThreshold(float $confidenceThreshold): self
    {
        $self = clone $this;
        $self['confidenceThreshold'] = $confidenceThreshold;

        return $self;
    }
}
