<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorUpdateResponse\ChangeDetection;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Detect exact changes. For page targets, this means visible text diffs. For sitemap targets, this means URL additions and removals.
 *
 * @phpstan-type MonitorsExactChangeDetectionShape = array{type: 'exact'}
 */
final class MonitorsExactChangeDetection implements BaseModel
{
    /** @use SdkModel<MonitorsExactChangeDetectionShape> */
    use SdkModel;

    /** @var 'exact' $type */
    #[Required]
    public string $type = 'exact';

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(): self
    {
        return new self;
    }

    /**
     * @param 'exact' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
