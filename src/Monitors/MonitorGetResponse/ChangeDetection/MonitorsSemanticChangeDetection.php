<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetResponse\ChangeDetection;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Detect meaning-level changes to tracked page content, ignoring cosmetic or paraphrase-only differences. Which changes are meaningful is judged against the extract target's `instructions` (and `schema`, when provided).
 *
 * @phpstan-type MonitorsSemanticChangeDetectionShape = array{
 *   type: 'semantic', confidenceThreshold?: float|null
 * }
 */
final class MonitorsSemanticChangeDetection implements BaseModel
{
    /** @use SdkModel<MonitorsSemanticChangeDetectionShape> */
    use SdkModel;

    /** @var 'semantic' $type */
    #[Required]
    public string $type = 'semantic';

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
